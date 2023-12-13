<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCompletedController extends Controller
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
            ->where('transactions.status', 1)
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
        return view('admin.completed.index', $data);
    }
}
