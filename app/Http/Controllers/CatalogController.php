<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    public function index()
    {
        // $userId = auth()->id();
        // $products = Product::select('products.*')
        //     ->selectRaw('IFNULL(liked_products.product_id, 0) AS isLiked')
        //     ->selectRaw('IFNULL(cart.product_id, 0) AS isCart')
        //     ->leftJoin('liked_products', function ($join) use ($userId) {
        //         $join->on('products.id', '=', 'liked_products.product_id')
        //             ->where('liked_products.user_id', '=', $userId);
        //     })
        //     ->leftJoin('cart', function ($join) use ($userId) {
        //         $join->on('products.id', '=', 'cart.product_id')
        //             ->where('cart.user_id', '=', $userId);
        //     })
        //     ->get();
        $data['is_active'] = 'catalog';
        return view('page.catalog', $data);
    }

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
        $query = Product::selectRaw('IFNULL(liked_products.is_liked, 0) AS isLiked')
            ->selectRaw('IFNULL(cart.is_cart, 0) AS isCart')
            ->leftJoin('liked_products', function ($join) use ($userId) {
                $join->on('products.id', '=', 'liked_products.product_id')
                    ->where('liked_products.user_id', '=', $userId);
            })
            ->leftJoin('cart', function ($join) use ($userId) {
                $join->on('products.id', '=', 'cart.product_id')
                    ->where('cart.user_id', '=', $userId);
            })
            ->select('products.*');
            
            $products =  $query->orderBy($orderColumn, $orderDirection)->paginate(12);

        // return $products;      
        return response()->json([
            'products' => $products->items(),
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'total' => $products->total(),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        //
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
        //
    }
}
