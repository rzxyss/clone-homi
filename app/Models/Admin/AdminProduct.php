<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProduct extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'product_name', 'price', 'discount', 'sold', 'subcategory_id', 'user_id', 'approve'
    ];

    public function images()
    {
        return $this->hasMany(AdminImageProduct::class, 'product_id');
    }
}
