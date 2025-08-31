<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * OrderItem model represents an item within an order.
 *
 * An order item belongs to both an order and a product. These
 * relationships use the belongsTo method so Eloquent knows
 * how to resolve the foreign keys. The naming convention for
 * foreign keys is inferred from the relationship name and
 * automatically suffixed with _id【304309859972425†L761-L846】.
 */
class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    /**
     * Get the order that owns the order item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product that belongs to the order item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}