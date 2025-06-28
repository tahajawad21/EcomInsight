<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // ✅ Add subcategory_id here
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'discount_price',
        'available',
        'is_featured',
        'stock',
        'brand_id',
        'subcategory_id',
        'latitude',
        'longitude',
    ];

    // ✅ Define relationship to Subcategory
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

      // (Optional) If using relationships later
      public function brand()
      {
          return $this->belongsTo(Brand::class);
      }
}
