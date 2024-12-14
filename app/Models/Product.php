<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'title', 'slug', 'description', 'price', 'compare_price',
        'category_id', 'sub_category_id', 'brand_id', 'sku',
        'barcode', 'track_qty', 'qty', 'status', 'is_featured',
    ];
    

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    protected $casts = [
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'qty' => 'integer',
        'status' => 'boolean',
    ];

    /**
     * Relationships
     */

    // Product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    
    
}
