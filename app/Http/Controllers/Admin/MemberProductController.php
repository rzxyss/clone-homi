<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AcceptUploadMember;
use App\Mail\DeniedUploadMember;
use App\Models\Admin\AdminProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class MemberProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')
            ->select(
                'products.id',
                'products.product_name',
                'products.price',
                'products.discount',
                'products.sold',
                'products.subcategory_id',
                'products.user_id',
                'products.approve',
                DB::raw('MAX(image_product.id) as image_id'),
                DB::raw('MAX(image_product.image) as image_path'),
                'users.role',
                'users.name',
                'users.email',
                'users.phone',
                'subcategories.subcategory_name'
            )
            ->leftJoin('image_product', 'products.id', '=', 'image_product.product_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
            ->groupBy(
                'products.id',
                'products.product_name',
                'products.price',
                'products.discount',
                'products.sold',
                'products.subcategory_id',
                'products.user_id',
                'products.approve',
                'users.role',
                'users.name',
                'users.email',
                'subcategories.subcategory_name',
                'users.phone'
            )
            ->where('users.role', '=', 'user')
            ->get();
        return view('admin.member.product', ['products' => $products]);
    }

    public function accept(Request $request, $id)
    {
        $product = AdminProduct::where('products.id', $id)->join('users', 'users.id', '=', 'products.user_id')
            ->select('products.*', 'users.email as email')
            ->first();
        $product->update([
            'approve' => 2
        ]);
        $details = [
            'syarat' => $request->input('syarat')
        ];
        $mail = Mail::to($product->email)->send(new AcceptUploadMember($details));
        return redirect(URL::previous())->with('message', 'Successfully Accepted Product!');
    }

    public function denied(Request $request, $id)
    {
        $product = AdminProduct::where('products.id', $id)->join('users', 'users.id', '=', 'products.user_id')
            ->select('products.*', 'users.email as email')
            ->first();
        $product->update([
            'approve' => 3
        ]);
        $details = [
            'nama_produk' => $product->product_name,
            'harga' => $product->price,
            'alasan' => $request->input('alasan'),
        ];
        $mail = Mail::to($product->email)->send(new DeniedUploadMember($details));
        return redirect(URL::previous())->with('message', 'Successfully Denied Product!');;
    }
}
