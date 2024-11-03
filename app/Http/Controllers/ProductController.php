<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('products.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'article' => 'required|unique:products',
            'name' => 'required',
            'description' => 'nullable',
            'color' => 'required',
            'season' => 'required|in:зима,лето,осень,весна',
            'price' => 'required|numeric',
            'sizes' => 'required',
            'material' => 'required',
            'brand' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product($request->all());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products.create')->with('success', 'Product created successfully.');
    }

    public function destroy(Product $product)
    {
        // Удаляем изображение, если оно существует
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.create')->with('success', 'Product deleted successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'article' => 'required|unique:products,article,' . $product->id,
            'name' => 'required',
            'description' => 'nullable',
            'color' => 'required',
            'season' => 'required|in:зима,лето,осень,весна',
            'price' => 'required|numeric',
            'sizes' => 'required',
            'material' => 'required',
            'brand' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Добавьте валидацию для изображения
        ]);

        $product->fill($request->all());

        if ($request->hasFile('image')) {
            // Удаляем старое изображение, если оно существует
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products.create')->with('success', 'Product updated successfully.');
    }

    public function importForm()
    {
        return view('products.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return redirect()->route('products.create')->with('success', 'Products imported successfully.');
    }
}