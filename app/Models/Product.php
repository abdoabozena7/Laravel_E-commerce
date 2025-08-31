<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Product model represents an item that can be purchased.
 *
 * Each product belongs to a single category (inverse of a one‑to‑many
 * relationship). The belongsTo relationship automatically uses the
 * snake cased name of the related model and adds an _id suffix to
 * determine the foreign key on this table【304309859972425†L761-L846】.
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image_url',
        // target_gender indicates the intended audience: men or women
        'target_gender',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the order items for the product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}