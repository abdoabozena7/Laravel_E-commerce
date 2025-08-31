<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Category model represents a product category.
 *
 * A category can have many products. This relationship is defined
 * using the hasMany method, which tells Eloquent that the related
 * products have a foreign key of category_id. The parent key is
 * determined automatically based on the model name and will be
 * snake cased with an _id suffix【304309859972425†L536-L599】.
 */
class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}