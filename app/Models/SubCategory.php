<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'subcategories';
    // protected $guarded = ['id'];

    // public $with = ['category'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
