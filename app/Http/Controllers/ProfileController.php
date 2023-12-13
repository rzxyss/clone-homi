<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->id();
        $account = DB::table('users')->where('id', '=', $user)->get()->first();
        $following = DB::table('follow')->where('user_id', $user)->count();
        $follower = DB::table('follow')->where('following', $user)->count();
        $is_active = '';
        $member_active = 'profile';
        return view('page.member.profile', ['account' => $account, 'followers' => $follower, 'following' => $following, 'is_active' => $is_active, 'member_active' => $member_active]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'username' => 'required',
        ]);

        $user = auth()->id();
        $account = User::findOrFail($user);
        if ($request->file('profile_image') != "") {
            $image = $request->file('profile_image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move('assets/images/profile', $imageName);
            $account->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'username' => $request->username,
                'photo' =>  $imageName
            ]);
        } else {
            $account->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'username' => $request->username
            ]);
        }
        return redirect('/member/profile')->with('message', 'Category Addedd!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
