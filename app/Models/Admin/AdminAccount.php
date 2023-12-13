<?php

namespace App\Models\Admin;

use App\Models\ReferralCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAccount extends Model
{
    use HasFactory;
    protected $table = 'users';

    protected $fillable = [
        'username', 'password', 'name', 'phone', 'email', 'role', 'date_of_birth'
    ];

    public function generateReferralCode()
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle(str_repeat($pool, 5)), 0, 8);

        $this->referralCode()->create(['code' => $code]);

        return $code;
    }

    public function referralCode()
    {
        return $this->hasOne(ReferralCode::class, 'user_id', 'id');
    }
}
