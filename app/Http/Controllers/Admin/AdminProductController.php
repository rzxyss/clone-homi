<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\AdminProduct;
use App\Models\Admin\AdminCategory;
use App\Models\Admin\AdminImageProduct;

class AdminProductController extends Controller
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
                DB::raw('MIN(image_product.id) as image_id'),
                DB::raw('MIN(image_product.image) as image'),
                'users.role',
                'users.name',
                'users.email',
                'users.phone',
                'subcategories.subcategory_name as subname'
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
            ->get();

        // dd($products);
        return view('admin.product.index', ['products' => $products]);
    }

    public function create()
    {
        $subcategories = DB::table('categories')->join('subcategories', 'subcategories.category_id', '=', 'categories.id')
            ->select('subcategories.*', 'categories.category_name')
            ->get();
        return view('admin.product.add', ['subcategories' => $subcategories]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'image.*' => 'required|image|mimes:png,jpg,jpeg',
            'price' => 'required',
            'discount' => 'required',
            'sold' => 'required',
            'category' => 'required',
        ]);

        $product = AdminProduct::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'sold' => $request->sold,
            'subcategory_id' => $request->category,
            'approve' => 1,
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move('assets/images/product', $imageName);
                $product->images()->create([
                    'image' => $imageName,
                ]);
            }
        }
        if ($product) {
            return redirect('admin/product')->with('message', 'Product Addedd!');
        } else {
            return redirect('admin/product')->with('error', 'Sorry, Failed Added Product!');
        }
    }

    public function edit(AdminProduct $product)
    {
        $subcategories = DB::table('categories')->join('subcategories', 'subcategories.category_id', '=', 'categories.id')
            ->select('subcategories.*', 'categories.category_name')
            ->get();
        $image = AdminImageProduct::where('product_id', $product->id)->get();
        $thumbnail = DB::table('image_product')
            ->select(
                DB::raw('MIN(image_product.id) as image_id'),
                DB::raw('MIN(image_product.image) as image')
            )
            ->where('product_id', '=', $product->id)
            ->get()->first();
        return view('admin.product.edit', compact('product'), ['subcategories' => $subcategories, 'image' => $image, 'thumbnail' => $thumbnail]);
    }

    public function update(Request $request, AdminProduct $product)
    {
        $product = AdminProduct::findOrFail($product->id);

        $product->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'sold' => $request->sold,
            'category_id' => $request->category,
        ]);
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move('assets/images/product', $imageName);
                $product->images()->create([
                    'image' => $imageName,
                ]);
            }
        }
        if ($product) {
            return redirect('admin/product')->with('message', 'Product Updatedd!');
        } else {
            return redirect('admin/product')->with('error', 'Sorry, Failed Updated Product!');
        }
    }

    public function destroy(AdminProduct $product)
    {
        $imagePath = asset('assets/images/product/' . $product->image);
        unlink($imagePath);
        $product->delete();
        if ($product) {
            return redirect('admin/product')->with('message', 'Product Deletedd!');
        } else {
            return redirect('admin/product')->with('error', 'Sorry, Failed Deleted Product!');
        }
        return redirect('admin/product')->with('flash_message', 'Product Deletedd!');
    }
}
