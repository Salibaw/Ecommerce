<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',   // Menambahkan name
        'slug',
        'showHome',
        'status',
        'image',  // Jika ada properti image di tabel
    ];
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
