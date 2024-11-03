<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order_product'; // Убедитесь, что таблица называется 'order_product'

    protected $fillable = [
        'products_id',
        'user_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}