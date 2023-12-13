<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminImageProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AdminImageController extends Controller
{
    public function delete($id)
    {
        $image = AdminImageProduct::where('id', $id)->first();
        $imagePath = asset('assets/images/product/' . $image->image);
        unlink($imagePath);
        $image->delete();
        return redirect(URL::previous())->with('message', 'Image Deletedd!');;
    }
}
