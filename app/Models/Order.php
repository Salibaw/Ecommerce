<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'grand_total',
        'status',
    ];    

    /**
     * Relationships
     */

    // Order has many items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
