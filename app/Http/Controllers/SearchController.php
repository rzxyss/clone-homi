<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $is_active = '';
        $category = $request->query('category');
        $keyword = $request->query('keyword');
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
                DB::raw('MIN(image_product.id) as image_id'),
                DB::raw('MIN(image_product.image) as image'),
                'subcategories.category_id as category_id',
                'categories.category_name as category',
                'liked_products.is_liked as isLiked',
                'cart.is_cart as isCart'
            )
            ->leftJoin('image_product', 'products.id', '=', 'image_product.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->leftJoin('liked_products', 'liked_products.product_id', '=', 'products.id')
            ->leftJoin('cart', 'cart.product_id', '=', 'products.id')
            ->groupBy(
                'products.id',
                'products.product_name',
                'products.price',
                'products.discount',
                'products.sold',
                'products.subcategory_id',
                'products.user_id',
                'products.approve',
                'subcategories.category_id',
                'categories.category_name',
                'liked_products.is_liked',
                'cart.is_cart'
            )
            ->where('categories.category_name', '=', $category)
            ->where('products.product_name', 'LIKE', '%' . $keyword . '%')
            ->get();
        return view('page.search', ['product' => $products, 'is_active' => $is_active]);
    }
}
