<?php

namespace App\Http\Controllers;

use App\Models\Admin\AdminImageProduct;
use App\Models\Blog;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\LikedProduct;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $data['category'] = Category::get();
        $data['is_active'] = 'home';
        $data['jumlah_produk'] = Product::count();


        $arsitektur = SubCategory::where('category_id', 1)->pluck('id')->toArray();
        $interior = SubCategory::where('category_id', 2)->pluck('id')->toArray();
        $data['carousel'] = AdminImageProduct::select(
            'product_id',
            DB::raw('MIN(image_product.id) as image_id'),
            DB::raw('MIN(image) as image'),
            'products.product_name'
        )->leftJoin('products', 'products.id', '=', 'image_product.product_id')
            ->groupBy('product_id', 'products.product_name')
            ->orderBy('image_product.created_at', 'desc')
            ->take(3)
            ->get();

        $data['blog'] = Blog::join('users', 'users.id', '=', 'blog.author')->select('blog.*', 'users.name')->orderBy('blog.created_at', 'desc')->take(5)->get();


        $data['heroArsitektur'] = Product::whereIn('subcategory_id', $arsitektur)->first();
        $data['arsitektur'] = $data['heroArsitektur']
                            ? Product::whereIn('subcategory_id', $arsitektur)
                                ->where('id', '!=', $data['heroArsitektur']->id)
                                ->latest()
                                ->take(4)
                                ->get()
                            : '';

        $data['heroInterior'] = Product::whereIn('subcategory_id', $interior)->first();
        $data['interior'] = $data['heroInterior']
                            ? Product::whereIn('subcategory_id', $interior)
                                ->where('id', '!=', $data['heroInterior']->id)
                                ->latest()
                                ->take(4)
                                ->get()
                            : '';


        return view('page.landing-page')->with($data);
    }

    public function loadProducts(Request $request)
    {
        $products = Product::latest()->paginate(3, ['*'], 'page', $request->page);

        $html = View::make('partials.products', compact('products'))->render();
        $html = 'a';
        return response()->json(['html' => $html]);
    }
}
