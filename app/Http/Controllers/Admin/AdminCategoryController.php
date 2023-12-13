<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\AdminCategory;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('admin.category.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.category.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name'     => 'required',
        ]);
        $category = AdminCategory::create([
            'category_name' => $request->category_name
        ]);
        if ($category) {
            return redirect('admin/category')->with('message', 'Category Addedd!');
        } else {
            return redirect('admin/category')->with('error', 'Sorry, Failed Added Category!');
        }
    }

    public function edit(AdminCategory $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, AdminCategory $category)
    {
        $category = AdminCategory::findOrFail($category->id);
        $category->update([
            'category_name' => $request->category_name
        ]);
        if ($category) {
            return redirect('admin/category')->with('message', 'Category Updatedd!');
        } else {
            return redirect('admin/category')->with('error', 'Sorry, Failed Updated Category!');
        }
    }

    public function destroy(AdminCategory $category)
    {
        $category->delete();
        if ($category) {
            return redirect('admin/category')->with('message', 'Category Deletedd!');
        } else {
            return redirect('admin/category')->with('error', 'Sorry, Failed Deleted Category!');
        }
    }
}
