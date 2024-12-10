<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // Specify the table name if necessary
    protected $table = 'brands';  // Optional if your table is 'brands'

    // Define which attributes are mass assignable
    protected $fillable = [
        'name',    // Add the 'name' field here
        'slug',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
