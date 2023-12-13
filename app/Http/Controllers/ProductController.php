<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Product;
use App\Models\ImageProduct;
use Illuminate\Http\Request;
use App\Models\Admin\AdminProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Mail\MemberProdukEdit;
use App\Mail\MemberProdukMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin\AdminImageProduct;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $products = DB::table('products')->where('user_id', '=', $userId)->get();
        foreach ($products as $data) {
            $image = DB::table('image_product')->where('product_id', '=', $data->id)->first();
            $data->image = $image->image;
        }
        $jumlah_produk = $products->count();

        $is_active = '';
        $member_active = 'produk';

        return view('page.member.produk.index', ['products' => $products, 'is_active' => $is_active, 'jumlah_produk' => $jumlah_produk, 'member_active' => $member_active]);
    }

    public function create()
    {
        $is_active = '';
        $subcategories = DB::table('categories')->join('subcategories', 'subcategories.category_id', '=', 'categories.id')
            ->select('subcategories.*', 'categories.category_name')
            ->get();
        $member_active = 'produk';
        return view('page.member.produk.add', ['subcategories' => $subcategories, 'is_active' => $is_active, 'member_active' => $member_active]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'image.*' => 'required|image|mimes:png,jpg,jpeg',
            'price' => 'required',
            'discount' => 'required',
            'sold' => 'required',
            'subcategory' => 'required',
        ]);

        $userId = auth()->id();

        $product = AdminProduct::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'sold' => $request->sold,
            'approve' => 0,
            'subcategory_id' => $request->subcategory,
            'user_id' => auth()->id()
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
        $member = DB::table('users')->where('id', $userId)->get()->first();
        $details = [
            'nama' => $member->name
        ];
        $mail = Mail::to('rzkysa0@gmail.com')->send(new MemberProdukMail($details));
        if ($product) {
            return redirect('/member/produk')->with('message', 'Product Addedd!');
        } else {
            return redirect('/member/produk')->with('error', 'Sorry, Failed Added Product!');
        }
    }

    public function show()
    {
    }

    public function edit($id)
    {
        $subcategories = DB::table('categories')->join('subcategories', 'subcategories.category_id', '=', 'categories.id')
            ->select('subcategories.*', 'categories.category_name')
            ->get();
        $data['list_image'] = DB::table('image_product')->where('product_id', $id)->get();
        $data['thumbnail'] = DB::table('image_product')
            ->select(
                DB::raw('MIN(image_product.id) as image_id'),
                DB::raw('MIN(image_product.image) as image')
            )
            ->where('product_id', '=', $id)
            ->get()->first();
        $data['product'] = DB::table('products')->where('id', $id)->get()->first();
        $data['is_active'] = '';
        $data['member_active'] = 'produk';
        // dd($data['image']);
        return view('page.member.produk.edit', $data);
    }

    public function detail($id)
    {
        $data['product'] = Product::where('id', $id)->first();
        $data['product']->viewers += 1;
        $data['product']->save();

        $data['image'] = ImageProduct::where('product_id', $id)->get();
        $data['likes'] = DB::table('liked_products')->where('product_id', $id)->where('is_liked', 1)->count();
        $data['user'] = DB::table('users')->where('id', $data['product']->user_id)->get()->first();

        $getFollowStatus = Follow::find($id);
        if ($getFollowStatus) {
            $data['followStatus'] = 1;
        } else {
            $data['followStatus'] = 0;
        }

        $data['is_active'] = 'katalog';
        $data['member_active'] = 'produk';
        return view('page.detail-product', $data);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $userId = auth()->id();
        $product->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'sold' => $request->sold,
            'category_id' => $request->category,
            'approve' => 0,
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

        $member = DB::table('users')->where('id', $userId)->get()->first();
        $details = [
            'nama' => $member->name
        ];
        $mail = Mail::to('rzkysa0@gmail.com')->send(new MemberProdukEdit($details));
        if ($product) {
            return redirect('/member/produk')->with('message', 'Product Updatedd!');
        } else {
            return redirect('/member/produk')->with('error', 'Sorry, Failed Updated Product!');
        }
    }

    public function delete_image($id)
    {
        $image = AdminImageProduct::where('id', $id)->first();
        $image->delete();
        if ($image->delete()) {
            $imagePath = asset('assets/images/product/' . $image->image);
            unlink($imagePath);
        }
        return redirect(URL::previous())->with('message', 'Image Deletedd!');
    }

    public function destroy($id)
    {
        //
    }

    public function accept($id)
    {
        $product = AdminProduct::where('products.id', $id)->first();
        $product->update([
            'approve' => 1
        ]);

        return redirect(URL::previous())->with('message', 'Produk Berhasil Di Upload!');
    }
}
