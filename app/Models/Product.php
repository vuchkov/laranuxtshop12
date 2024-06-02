<?php

namespace App\Models;

use App\Contracts\ProductInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements ProductInterface
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

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setCategoryId(?int $categoryId): void
    {
        $this->category_id = $categoryId;
    }

}
