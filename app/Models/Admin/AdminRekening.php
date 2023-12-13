<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRekening extends Model
{
    use HasFactory;
    protected $table = 'rekening';
    protected $fillable = [
        'bank', 'no_rek', 'atas_nama'
    ];
}
