<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminImageProduct extends Model
{
    use HasFactory;
    protected $table = 'image_product';
    protected $fillable = [
        'image',
    ];

    public function product()
    {
        return $this->belongsTo(AdminProduct::class, 'product_id');
    }
}
