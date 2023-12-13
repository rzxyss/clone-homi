<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index()
    {
        $data['is_active'] = 'testimoni';
        $data['testimoni'] = Testimoni::all();
        return view('page.testimoni', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:dns',
            'testimoni' => 'required',
            'website' => ''
        ]);

        $testimoni = Testimoni::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'testimoni' => $request->input('testimoni'),
            'website' => $request->input('website'),
        ]);

        if ($testimoni) {
            return redirect('/');
        }
    }
}
