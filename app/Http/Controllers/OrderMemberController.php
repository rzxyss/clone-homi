<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderMemberController extends Controller
{
    public function index()
    {
        $data['is_active'] = '';
        $data['order'] = DB::table('transactions')
            ->select(
                'transactions.*',
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
            ->where('products.user_id', auth()->id())
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
                'transactions.created_at',
                'transactions.updated_at',
                'users.name',
                'users.email',
                'users.phone',
            )->get();
        $data['jumlah_order'] = $data['order']->count();
        $data['member_active'] = 'pesanan';
        return view('page.member.list-order', $data);
    }
}
