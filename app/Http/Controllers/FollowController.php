<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow($id)
    {
        if (Auth::user()) {
            $getFollow = Follow::where('user_id', auth()->user()->id);
            
            $isFollow = $getFollow->where('following', $id)->first();
            $followedUser = User::where('id', $id)->first();

            if ($isFollow) {
                $isFollow->delete();
                auth()->user()->following -= 1;
                $followedUser->followers -= 1;
                $followedUser->update();

                return response()->json([
                    'followStatus' => 0,
                    'totalFollowers' => $followedUser->followers,
                    'message' => 'Batal Mengikuti',
                ]);
            } else {
                $new  = new Follow();
                $new->user_id = auth()->user()->id;
                $new->following = $id;
                $new->save();

                auth()->user()->following += 1;
                $followedUser->followers += 1;
                $followedUser->update();

                return response()->json([
                    'followStatus' => 1,
                    'totalFollowers' => $followedUser->followers,
                    'message' => 'Berhasil Mengikuti',
                ]);
            }
        } else {
            return response()->json(['error' => 'Silahkan Login terlebih dahulu!']);
        }
    }
}
