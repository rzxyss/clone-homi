<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class MyOrderController extends Controller
{
    public function index()
    {
        $data['order'] = DB::table('transactions')->where('transactions.user_id', auth()->id())
            ->select(
                'transactions.*',
                'products.*',
                DB::raw('MIN(image_product.id) as image_id'),
                DB::raw('MIN(image_product.image) as image'),
            )
            ->leftJoin('image_product', 'transactions.product_id', '=', 'image_product.product_id')
            ->leftJoin('products', 'products.id', '=', 'transactions.product_id')
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
            )->get();
        $data['jumlah_order'] = $data['order']->count();
        $data['is_active'] = '';
        $data['member_active'] = 'pesanan-saya';
        return view('page.member.my-order', $data);
    }

    public function donwload_image($id)
    {
        $images = DB::table('image_product')->where('product_id', $id)->get();
        $produk = DB::table('products')->where('id', $id)->get()->first();

        $zip = new ZipArchive;
        $zipFileName = $produk->product_name . '.zip';
        $zip->open($zipFileName, ZipArchive::CREATE);

        foreach ($images as $image) {
            $imagePath = 'assets/images/product/' . $image->image;
            $zip->addFile(public_path($imagePath), basename($imagePath));
        }
        $zip->close();
        return response()->download($zipFileName)->deleteFileAfterSend(true);
    }
}
