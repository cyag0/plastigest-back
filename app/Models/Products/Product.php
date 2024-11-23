<?php

namespace App\Models\Products;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'supplier_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
