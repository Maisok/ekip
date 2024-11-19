<?php


namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test product creation.
     *
     * @return void
     */
    public function testProductCreation()
    {
        // Аутентификация пользователя
        $user = User::factory()->create();
        $this->actingAs($user);
    
        $productData = [
            'article' => $this->faker->unique()->word,
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'color' => $this->faker->colorName,
            'season' => $this->faker->randomElement(['зима', 'лето', 'осень', 'весна']),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'sizes' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'material' => $this->faker->word,
            'brand' => $this->faker->word,
        ];
    
        $response = $this->post(route('products.store'), $productData);
    
        $response->assertRedirect(route('products.create'));
        $response->assertSessionHas('success', 'Product created successfully.');
    
        $this->assertDatabaseHas('products', [
            'article' => $productData['article'],
            'name' => $productData['name'],
            'description' => $productData['description'],
            'color' => $productData['color'],
            'season' => $productData['season'],
            'price' => $productData['price'],
            'sizes' => $productData['sizes'],
            'material' => $productData['material'],
            'brand' => $productData['brand'],
        ]);
    }
    
    public function testProductUpdate()
    {
        // Аутентификация пользователя
        $user = User::factory()->create();
        $this->actingAs($user);
    
        $product = Product::factory()->create();
    
        $updatedData = [
            'article' => $this->faker->unique()->word,
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'color' => $this->faker->colorName,
            'season' => $this->faker->randomElement(['зима', 'лето', 'осень', 'весна']),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'sizes' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'material' => $this->faker->word,
            'brand' => $this->faker->word,
        ];
    
        $response = $this->put(route('products.update', $product->id), $updatedData);
    
        $response->assertRedirect(route('products.create'));
        $response->assertSessionHas('success', 'Product updated successfully.');
    
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'article' => $updatedData['article'],
            'name' => $updatedData['name'],
            'description' => $updatedData['description'],
            'color' => $updatedData['color'],
            'season' => $updatedData['season'],
            'price' => $updatedData['price'],
            'sizes' => $updatedData['sizes'],
            'material' => $updatedData['material'],
            'brand' => $updatedData['brand'],
        ]);
    }
    
    public function testProductDeletion()
    {
        // Аутентификация пользователя
        $user = User::factory()->create();
        $this->actingAs($user);
    
        $product = Product::factory()->create([
            'image' => 'products/product.jpg',
        ]);
    
        Storage::disk('public')->put($product->image, 'image content');
    
        $response = $this->delete(route('products.destroy', $product->id));
    
        $response->assertRedirect(route('products.create'));
        $response->assertSessionHas('success', 'Product deleted successfully.');
    
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing($product->image);
    }
}