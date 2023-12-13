<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = DB::table('categories')->join('subcategories', 'categories.id', '=', 'subcategories.category_id')->select('categories.category_name', 'subcategories.*')->get();
        return view('admin.subcategory.index', ['subcategories' => $subcategories]);
    }

    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('admin.subcategory.add', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subcategory_name' => 'required',
            'category' => 'required'
        ]);

        $subcategory = AdminSubcategory::create([
            'subcategory_name' => $request->subcategory_name,
            'category_id'     => $request->category
        ]);
        if ($subcategory) {
            return redirect('admin/subcategory')->with('message', 'Category Addedd!');
        } else {
            return redirect('admin/subcategory')->with('error', 'Sorry, Failed Added Category!');
        }
    }

    public function edit(AdminSubcategory $subcategory)
    {
        $categories = DB::table('categories')->get();
        return view('admin.subcategory.edit', compact('subcategory'), ['categories' => $categories]);
    }

    public function update(Request $request, AdminSubcategory $subcategory)
    {
        $subcategory = AdminSubcategory::findOrFail($subcategory->id);
        $subcategory->update([
            'subcategory_name' => $request->subcategory_name,
            'category_id' => $request->category
        ]);
        if ($subcategory) {
            return redirect('admin/subcategory')->with('message', 'Category Addedd!');
        } else {
            return redirect('admin/subcategory')->with('error', 'Sorry, Failed Added Category!');
        }
    }

    public function destroy(AdminSubcategory $subcategory)
    {
        $subcategory->delete();
        if ($subcategory) {
            return redirect('admin/subcategory')->with('message', 'Category Deletedd!');
        } else {
            return redirect('admin/subcategory')->with('error', 'Sorry, Failed Deleted Category!');
        }
    }
}
