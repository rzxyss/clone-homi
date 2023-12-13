<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferralController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $code = DB::table('referral_codes')->where('user_id', '=', $userId)->get()->first();
        $referral_code = DB::table('referral_codes')->where('user_id', '=', $userId)
            ->join('users', 'users.invited_code', '=', 'referral_codes.code')
            ->select('referral_codes.*', 'users.name', 'users.email', 'users.phone')->get();
        $isUse = DB::table('referral_codes')->where('user_id', '=', $userId)
            ->join('users', 'users.invited_code', '=', 'referral_codes.code')
            ->select('referral_codes.*', 'users.name', 'users.email', 'users.phone')->get()->count();
        $is_active = '';
        $member_active = 'referral-code';
        return view('page.member.my-referral', ['code' => $code, 'users' => $referral_code, 'is_active' => $is_active, 'isUse' => $isUse, 'member_active' => $member_active]);
    }
}
