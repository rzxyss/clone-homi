<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\LikedProduct;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class LikedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['liked'] = LikedProduct::where('liked_products.user_id', '=', auth()->user()->id)
            ->where('is_liked', 1)
            ->get();
        $data['jumlah_data'] = $data['liked']->count() > 0;
        $data['is_active'] = '';
        return view('page.liked-product', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sort($sortType)
    {
        switch ($sortType) {
            case 'newest':
                $orderColumn = 'created_at';
                $orderDirection = 'desc';
                break;
            case 'oldest':
                $orderColumn = 'created_at';
                $orderDirection = 'asc';
                break;
            case 'best-seller':
                $orderColumn = 'sold';
                $orderDirection = 'desc';
                break;
            case 'high-price':
                $orderColumn = 'price';
                $orderDirection = 'desc';
                break;
            case 'low-price':
                $orderColumn = 'price';
                $orderDirection = 'asc';
                break;
            default:
                $orderColumn = 'created_at';
                $orderDirection = 'desc';
        }

        $userId = auth()->id();
        $likedProduct = Product::select(
            'products.*',
            DB::raw('MIN(image_product.id) as image_id'),
            DB::raw('MIN(image_product.image) as image'),
        )
            ->selectRaw('IFNULL(liked_products.is_liked, 0) AS isLiked')
            ->selectRaw('IFNULL(cart.is_cart, 0) AS isCart')
            ->leftJoin('liked_products', function ($join) use ($userId) {
                $join->on('products.id', '=', 'liked_products.product_id')
                    ->where('liked_products.user_id', '=', $userId);
            })
            ->leftJoin('image_product', function ($join) use ($userId) {
                $join->on('products.id', '=', 'image_product.product_id');
            })
            ->leftJoin('cart', function ($join) use ($userId) {
                $join->on('products.id', '=', 'cart.product_id')
                    ->where('cart.user_id', '=', $userId);
            })
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
                'liked_products.id',
                'liked_products.product_id',
                'liked_products.user_id',
                'liked_products.is_liked',
            )
            ->where('is_Liked', 1)
            ->orderBy($orderColumn, $orderDirection)
            ->paginate(12);
        return response()->json([
            'product' => $likedProduct->items(),
            'pagination' => [
                'current_page' => $likedProduct->currentPage(),
                'last_page' => $likedProduct->lastPage(),
                'total' => $likedProduct->total(),
            ],
        ]);
    }

    public function likeToggle($productId)
    {
        if (Auth::user()) {
            $user = auth()->user();

            $existingLike = LikedProduct::where('user_id', $user->id)->where('product_id', $productId)->first();
            $likesCount = LikedProduct::where('product_id', $productId)->where('is_liked', 1);
            if ($existingLike) {
                $existingLike->is_liked = $existingLike->is_liked == 1 ? 0 : 1;
                $existingLike->delete();

                $message = $existingLike->is_liked == 1 ? 'Menambahkan ke Wishlist' : 'Menghapus dari Wishlist';

                $responseData = [
                    'isLiked' => $existingLike->is_liked,
                    'productId' => $productId,
                    'likes' => $likesCount->count(),
                    'message' => $message
                ];

                return response()->json($responseData);
            } else {
                $new  = new LikedProduct();
                $new->product_id = $productId;
                $new->user_id = $user->id;
                $new->is_liked = 1;
                $new->save();

                $responseData = [
                    'isLiked' => 1,
                    'likes' => $likesCount->count(),
                    'productId' => $productId,
                    'message' => 'Menambahkan ke Wishlist'
                ];

                return response()->json($responseData);
            }
        } else {
            $responseData = [
                'error' => 'Silahkan Login Terlebih Dahulu!'
            ];
            return response()->json($responseData);
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product)
    {
        // return redirect()->route('liked-products.index')->with(['success', '!']);
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
        $liked = LikedProduct::find($id);
        $liked->destroy();
    }
}
