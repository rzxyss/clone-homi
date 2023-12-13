<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\AdminAccount;
use Carbon\Carbon;

class AdminAccountController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();
        return view('admin.account.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.account.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'role' => 'required',
        ]);

        $account = AdminAccount::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);
        $account->generateReferralCode();
        if ($account) {
            return redirect('admin/account')->with('message', 'Account Addedd!');
        } else {
            return redirect('admin/account')->with('error', 'Sorry, Failed Added Account!');
        }
    }

    public function edit(AdminAccount $account)
    {
        return view('admin.account.edit', compact('account'));
    }

    public function update(Request $request, AdminAccount $account)
    {
        $account = AdminAccount::findOrFail($account->id);
        $account->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'role' => $request->role
        ]);
        if ($account) {
            return redirect('admin/account')->with('message', 'Account Addedd!');
        } else {
            return redirect('admin/account')->with('error', 'Sorry, Failed Added Account!');
        }
    }

    public function destroy($id)
    {
        //
    }
}
