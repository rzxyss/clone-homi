@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Add Rekening</h5>
      <a href="/admin/rekening" class="btn btn-danger float-end">Cancel</a>
    </div>
    <div class="card-body">
      <form action="{{ url('admin/rekening') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label class="form-label">Bank</label>
          <select class="form-select" name="bank">
            <option value="" selected disabled>Pilih..</option>
            <option value="BCA">BCA</option>
            <option value="BNI">BRI</option>
            <option value="BNI">BNI</option>
            <option value="MANDIRI">MANDIRI</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Nomor Rekening</label>
          <input type="text" name="no_rek" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Atas Nama</label>
          <input type="text" name="atas_nama" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
      </form>
    </div>
  </div>
</div>
@endsection