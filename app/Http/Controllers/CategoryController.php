<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Admin\AdminSubCategory as SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->subcategory_name) {
            $userId = auth()->id();
            $subcategory = SubCategory::where('subcategory_name', $request->subcategory_name)->first();
            $data['category'] = Category::where('id', $subcategory->category_id)->select('category_name')->first();
            // foreach($category as $item) {
            //     $data['category'] = $item->category_name;
            // }
            $data['products'] = Product::where('subcategory_id', $subcategory->id)->orderBy('id', 'DESC')->get();
            $data['bestseller'] = Product::where('subcategory_id', $subcategory->id)
                                ->select('products.*')
                                ->selectRaw('IFNULL(liked_products.is_liked, 0) AS isLiked')
                                ->selectRaw('IFNULL(cart.is_cart, 0) AS isCart')
                                ->leftJoin('liked_products', function ($join) use ($userId) {
                                    $join->on('products.id', '=', 'liked_products.product_id')
                                        ->where('liked_products.user_id', '=', $userId);
                                })
                                ->leftJoin('cart', function ($join) use ($userId) {
                                    $join->on('products.id', '=', 'cart.product_id')
                                        ->where('cart.user_id', '=', $userId);
                                })
                                ->orderBy('sold', 'DESC')
                                ->take(3)->get();
            $data['subcategory'] = $subcategory;
            $data['is_active'] = 'category';
            return view('page.category', $data);
        } else {
            $userId = auth()->id();
            $products = Product::where('subcategory_id', $subcategory->id)
                                ->selectRaw('IFNULL(liked_products.is_liked, 0) AS isLiked')
                                ->selectRaw('IFNULL(cart.is_cart, 0) AS isCart')
                                ->leftJoin('liked_products', function ($join) use ($userId) {
                                    $join->on('products.id', '=', 'liked_products.product_id')
                                        ->where('liked_products.user_id', '=', $userId);
                                })
                                ->leftJoin('cart', function ($join) use ($userId) {
                                    $join->on('products.id', '=', 'cart.product_id')
                                        ->where('cart.user_id', '=', $userId);
                                })
                                ->select('products.*')
                                ->orderBy('id', 'DESC')
                                ->take(3)->get();
            $is_active = 'category';
            return view('page.catalog', ['products' => $products, 'is_active' => $is_active]);
        }
    }

    public function sort($subcategory, $sortType)
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
        // dd($category);
        $userId = auth()->id();
        // $getIdCategory = Category::where('id', $category)->first();
        // $getIdSubCategory = SubCategory::where('category_id', $getIdCategory->id)->first();
        $query = Product::where('subcategory_id', $subcategory)
            ->select('products.*')
            ->selectRaw('IFNULL(liked_products.is_liked, 0) AS isLiked')
            ->selectRaw('IFNULL(cart.is_cart, 0) AS isCart')
            ->leftJoin('liked_products', function ($join) use ($userId) {
                $join->on('products.id', '=', 'liked_products.product_id')
                    ->where('liked_products.user_id', '=', $userId);
            })
            ->leftJoin('cart', function ($join) use ($userId) {
                $join->on('products.id', '=', 'cart.product_id')
                    ->where('cart.user_id', '=', $userId);
            });
            
        $products = $query->orderBy($orderColumn, $orderDirection)->paginate(12);

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
