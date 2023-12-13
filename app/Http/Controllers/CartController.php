<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['cart'] = DB::table('cart')->join('products', 'cart.product_id', '=', 'products.id')
            ->where('is_cart', 1)
            ->select(
                'cart.*',
                'products.*',
                DB::raw('MIN(image_product.id) as image_id'),
                DB::raw('MIN(image_product.image) as image'),
            )
            ->leftJoin('image_product', 'products.id', '=', 'image_product.product_id')
            ->where(
                'cart.user_id',
                '=',
                auth()->user()->id
            )
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
                'cart.id',
                'cart.product_id',
                'cart.user_id',
                'cart.is_cart',
                'cart.created_at',
                'cart.updated_at',
            )->get();
        $data['total_data'] = $data['cart']->count() > 0;
        $data['is_active'] = '';
        $data['total'] = 0;
        return view('page.cart', $data);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'selected_product.*' => 'required',
        ]);

        session(['selected_product' => $request->selected_product]);
        return redirect('checkout');
    }

    public function cartToggle($productId)
    {
        if (Auth::user()) {
            $user = auth()->user();
            $cart = Cart::where('user_id', $user->id);
            if ($cart->count() <= 30) {
                $existingCart = $cart->where('product_id', $productId)->first();

                if ($existingCart) {
                    $existingCart->is_cart = $existingCart->is_cart == 1 ? 0 : 1;
                    $existingCart->delete();

                    $message = $existingCart->is_cart == 1 ? 'Menambahkan Produk Kedalam Keranjang anda' : 'Menghapus Produk dari Keranjang anda';

                    return response()->json([
                        'isCart' => $existingCart->is_cart,
                        'productId' => $productId,
                        'message' => $message
                    ]);
                } else {
                    $new  = new Cart();
                    $new->product_id = $productId;
                    $new->user_id = $user->id;
                    $new->is_cart = 1;
                    $new->save();

                    return response()->json([
                        'isCart' => 1,
                        'productId' => $productId,
                        'message' => 'Menambahkan produk kedalam keranjang anda'
                    ]);
                }
            } else {
                return response()->json([
                    'isCart' => 0,
                    'productId' => $productId,
                    'message' => 'Keranjang anda sudah penuh, Silahkan kosongkan beberapa produk terlebih dahulu'
                ]);
            }
        } else {
            return response()->json(['error' => 'Silahkan Login Terlebih Dahulu!']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Cart $cart, Product $product)
    {
        // 
    }

    public function delete(Cart $cart, Product $product)
    {
        $user = auth()->user();
        if (Auth::user()) {
            $existingCart = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();

            $delete = $existingCart->delete();
            return redirect()->to(URL::previous());
        } else {
            return response()->json(['error' => 'Silahkan login terlebih dahulu!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()) {
            $cart = Cart::where('product_id', $id)->first();
            $cart->update([
                'is_cart' => 0
            ]);
            return redirect()->back()->with(['success' => 'Produk Berhasil dihapus dari Keranjang anda!']);
        } else {
            return response()->json(['error' => 'Silahkan Login terlebih dahulu!']);
        }
    }
}
