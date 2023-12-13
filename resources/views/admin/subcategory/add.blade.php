@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Add Sub Category</h5>
      <a href="/admin/subcategory" class="btn btn-danger float-end">Cancel</a>
    </div>
    <div class="card-body">
      <form action="{{ asset('admin/subcategory') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label class="form-label">Sub Category Name</label>
          <input type="text" name="subcategory_name" id="subcategory_name" class="form-control" placeholder="Modern"
            required />
        </div>
        <div class="mb-3">
          <label class="form-label">Category</label>
          <select class="form-select" name="category">
            <option value="" selected disabled>Choose...</option>
            @foreach ($categories as $data)
            <option value="{{$data->id}}">{{$data->category_name}}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
      </form>
    </div>
  </div>
</div>
@endsection