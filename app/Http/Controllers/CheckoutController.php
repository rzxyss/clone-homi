<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PurchasedProduct;
use App\Http\Controllers\Controller;
use App\Mail\IncomingMail;
use Mail;
use App\Models\Admin\AdminRekening;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('check-access:user');
    // }

    public function index()
    {
        if (!session('selected_product') && Auth::user()) {
            return redirect('/home');
        } else {
            $data['rekening'] = AdminRekening::all();
            $data['is_active'] = '';
            $data['user'] = DB::table('users')->where('id', '=', auth()->id())->get()->first();
            $productId = session('selected_product', []);
            $data['produk'] = DB::table('products')
                ->select(
                    'products.*',
                    DB::raw('MIN(image_product.id) as image_id'),
                    DB::raw('MIN(image_product.image) as image'),
                )
                ->leftJoin('image_product', 'products.id', '=', 'image_product.product_id')
                ->whereIn('products.id', $productId)
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
                )->get();
            return view('page.checkout')->with($data);
        }
    }

    public function show()
    {
        // 
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'bank' => 'required',
            'proof' => 'required'
        ]);

        $selected = session('selected_product');
        $idProduct = session('selected_product', []);
        if ($request->hasFile('proof')) {
            $image = $request->file('proof');
            $imageName = $image->getClientOriginalName();
            $image->move('assets/images/proof', $imageName);
        }
        foreach ($selected as $i => $produk) {
            $transaksi = Transaction::create([
                'status' => 0,
                'payment_bank' => $request->input('bank'),
                'payment_proof' => $request->file('proof')->getClientOriginalName(),
                'user_id' => auth()->id(),
                'product_id' => $produk
            ]);
            if ($transaksi) {
                DB::table('cart')->whereIn('product_id', $idProduct)->where('user_id', auth()->id())->delete();
            }
        }

        $oldProduk = DB::table('products')->whereIn('id', $idProduct)->get()->first();
        DB::table('products')->whereIn('id', $idProduct)->update([
            'sold' => intval($oldProduk->sold) + 1
        ]);
        $details = [
            'product' => $oldProduk
        ];
        try {
            $mail = Mail::to('rzkysa0@gmail.com')->send(new IncomingMail($details));
        } catch (\Exception $e) {
            return redirect()->back()->with('success', $e->getMessage());
        }
        session()->forget('selected_product');
        return redirect('/')->with('success', 'Berhasil Memesan Produk');
    }
}
