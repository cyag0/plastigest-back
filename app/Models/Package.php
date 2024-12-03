<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Product;

class Package extends Model
{
    protected $fillable = [
        'id',
        'name',
        'product_id',
        'labels',
        'code',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    use HasFactory;
}
