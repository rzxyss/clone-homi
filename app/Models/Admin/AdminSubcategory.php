<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSubcategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';

    protected $fillable = [
        'subcategory_name', 'category_id'
    ];

    public function categories()
    {
        return $this->belongsTo(AdminCategory::class);
    }
}
