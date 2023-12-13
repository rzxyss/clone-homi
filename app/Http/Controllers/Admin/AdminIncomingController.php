<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AcceptTransactionMail;
use App\Mail\DeniedTransactionMail;
use App\Mail\Notification;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AdminIncomingController extends Controller
{
    public function index()
    {
        $data['incoming'] = DB::table('transactions')
            ->select(
                'transactions.id as id_transaction',
                'transactions.status',
                'transactions.payment_bank',
                'transactions.payment_proof',
                'transactions.user_id',
                'transactions.product_id',
                'transactions.completion_date',
                'products.*',
                'users.name',
                'users.email',
                'users.phone',
                DB::raw('MIN(image_product.id) as image_id'),
                DB::raw('MIN(image_product.image) as image'),
            )
            ->leftJoin('image_product', 'transactions.product_id', '=', 'image_product.product_id')
            ->leftJoin('products', 'products.id', '=', 'transactions.product_id')
            ->leftJoin('users', 'users.id', '=', 'transactions.user_id')
            ->where('transactions.status', 0)
            ->groupBy(
                'products.id',
                'products.product_name',
                'products.price',
                'products.discount',
                'products.sold',
                'products.subcategory_id',
                'products.user_id',
                'products.approve',
                'products.viewers',
                'products.created_at',
                'products.updated_at',
                'transactions.id',
                'transactions.status',
                'transactions.payment_bank',
                'transactions.payment_proof',
                'transactions.user_id',
                'transactions.product_id',
                'transactions.completion_date',
                'users.name',
                'users.email',
                'users.phone',
            )->get();
        $data['total_incoming'] = $data['incoming']->count();
        return view('admin.incoming.index', $data);
    }

    public function accept($id)
    {
        $transaksi = Transaction::where('id', $id)->first();
        $details = [
            'product' => DB::table('products')->where('id', $transaksi->product_id)->get()->first(),
            'date' => now()
        ];
        $customer = DB::table('users')->where('id', $transaksi->user_id)->get()->first();
        $mail = Mail::to($customer->email)->send(new AcceptTransactionMail($details));
        if ($mail) {
            $transaksi->update([
                'status' => 1
            ]);
            if ($transaksi) {
                return redirect(URL::previous())->with('message', 'Successfully Accepted Transaction!');
            } else {
                return redirect(URL::previous())->with('error', 'Something Went Wrong, Please Try Again!');
            }
        } else {
            return redirect(URL::previous())->with('error', 'Failed to Send Message to Email, Please Try Again!');
        }
    }

    public function denied(Request $request, $id)
    {
        $transaksi = Transaction::where('id', $id)->first();
        $details = [
            'product' => DB::table('products')->where('id', $transaksi->product_id)->get()->first(),
            'date' => now(),
            'reason' => $request->input('alasan')
        ];
        $customer = DB::table('users')->where('id', $transaksi->user_id)->get()->first();
        $mail = Mail::to($customer->email)->send(new DeniedTransactionMail($details));
        if ($mail) {
            $transaksi->update([
                'status' => 3
            ]);
            if ($transaksi) {
                return redirect(URL::previous())->with('message', 'Successfully Decline Transaction!');
            } else {
                return redirect(URL::previous())->with('error', 'Something Went Wrong, Please Try Again!');
            }
        } else {
            return redirect(URL::previous())->with('error', 'Failed to Send Message to Email, Please Try Again!');
        }
    }
}
