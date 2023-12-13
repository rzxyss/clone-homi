<?php

namespace App\Models;

use App\Models\LikedProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = ['id'];

    protected $with = ['image', 'subcategory'];

    /**
     * Get the user associated with the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function likedProducts()
    {
        return $this->hasMany(LikedProduct::class);
    }

    public function comment()
    {
        return $this->hasOne(CommentProduct::class);
    }

    public function image()
    {
        return $this->hasOne(ImageProduct::class);
    }

    public function images()
    {
        return $this->hasMany(ImageProduct::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function like() 
    {
        return $this->hasOne(LikedProduct::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
