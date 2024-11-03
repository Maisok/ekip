<?php
namespace App\Imports;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([
            'article' => $row['article'],
            'name' => $row['name'],
            'description' => $row['description'],
            'color' => $row['color'],
            'season' => $row['season'],
            'price' => $row['price'],
            'sizes' => $row['sizes'],
            'material' => $row['material'],
            'brand' => $row['brand'],
            'image' => $row['image'],
        ]);
    }
}