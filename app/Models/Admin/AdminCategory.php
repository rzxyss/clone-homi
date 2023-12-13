<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCategory extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = [
        'category_name', 'image'
    ];

    public function subcategories()
    {
        return $this->hasMany(AdminSubcategory::class, 'category_id');
    }
}
