@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Rekening</h5>
            <a href="/admin/rekening" class="btn btn-danger float-end">Cancel</a>
        </div>
        <div class="card-body">
            <form action="{{ route('rekening.update', $rekening->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Bank</label>
                    <select class="form-select" name="bank">
                        <option value="" selected disabled>Pilih..</option>
                        <option {{old('bank', $rekening->bank) == "BCA" ? 'selected' : ''}} value="BCA">BCA</option>
                        <option {{old('bank', $rekening->bank) == "BRI" ? 'selected' : ''}} value="BNI">BRI</option>
                        <option {{old('bank', $rekening->bank) == "BNI" ? 'selected' : ''}}value="BNI">BNI</option>
                        <option {{old('bank', $rekening->bank) == "MANIDIRI" ? 'selected' : ''}}value="MANDIRI">MANDIRI
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Rekening</label>
                    <input type="text" name="no_rek" class="form-control" value="{{old('no_rek', $rekening->no_rek)}}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Atas Nama</label>
                    <input type="text" name="atas_nama" class="form-control"
                        value="{{old('atas_nama', $rekening->atas_nama)}}">
                </div>
                <button type=" submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection