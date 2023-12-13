@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Add Category</h5>
      <a href="/admin/category" class="btn btn-danger float-end">Cancel</a>
    </div>
    <div class="card-body">
      <form action="{{ url('admin/category') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label class="form-label">Category Name</label>
          <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Modern"
            required />
        </div>
        <button type="submit" class="btn btn-success">Save</button>
      </form>
    </div>
  </div>
</div>
@endsection