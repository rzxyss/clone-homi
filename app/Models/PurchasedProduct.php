<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedProduct extends Model
{
    use HasFactory;

    protected $table = 'purchased_products';
    protected $guarded = ['id'];

    public function transaction()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_id', 'product_id');
    }
}
