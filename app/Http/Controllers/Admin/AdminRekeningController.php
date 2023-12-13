<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminRekening;
use Illuminate\Http\Request;

class AdminRekeningController extends Controller
{
    public function index()
    {
        $rekening = AdminRekening::all();
        return view('admin.rekening.index', ['rekening' => $rekening]);
    }

    public function create()
    {
        return view('admin.rekening.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'bank' => 'required',
            'no_rek' => 'required',
            'atas_nama' => 'required'
        ]);

        $rekening = AdminRekening::create([
            'bank' => $request->bank,
            'no_rek' => $request->no_rek,
            'atas_nama' => $request->atas_nama,
        ]);
        if ($rekening) {
            return redirect('admin/rekening')->with('message', 'Rekening Addedd!');
        } else {
            return redirect('admin/rekening')->with('error', 'Sorry, Failed Added Rekening!');
        }
    }

    public function edit(AdminRekening $rekening)
    {
        return view('admin.rekening.edit', compact('rekening'));
    }

    public function update(Request $request, AdminRekening $rekening)
    {
        $rekening->update([
            'bank' => $request->bank,
            'no_rek' => $request->no_rek,
            'atas_nama' => $request->atas_nama,
        ]);
        if ($rekening) {
            return redirect('admin/rekening')->with('message', 'Rekening Updatedd!');
        } else {
            return redirect('admin/rekening')->with('error', 'Sorry, Failed Updated Rekening!');
        }
    }

    public function destroy(AdminRekening $rekening)
    {
        $rekening->delete();
        if ($rekening) {
            return redirect('admin/rekening')->with('message', 'Rekening Deletedd!');
        } else {
            return redirect('admin/rekening')->with('error', 'Sorry, Failed Deleted Rekening!');
        }
    }
}
