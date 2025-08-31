<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Order model represents a purchase transaction.
 *
 * An order belongs to a user and contains many order items. The
 * relationship to the user is defined using belongsTo, which
 * automatically infers the foreign key name from the relationship
 * method【304309859972425†L761-L846】. The items method defines a one‑to‑many
 * relationship between orders and order items.
 */
class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status',
        'total_amount',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order items for the order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}