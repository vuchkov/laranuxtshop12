<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'email',
        'products',
        'total_price',
        'paid',
    ];

    // Add relationship with Product model (has many)
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getReferenceNumberAttribute()
    {
        // Get today's date components
        $year = now()->format('Y');
        $month = now()->format('m');
        $day = now()->format('d');

        // Generate the reference number string
        return "F{$year}{$month}{$day}" . str_pad($this->id + 500, 5, '0', STR_PAD_LEFT);
    }
}
