<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'price',
        'category_id',
    ];

    // Add relationships with Category model if needed
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
