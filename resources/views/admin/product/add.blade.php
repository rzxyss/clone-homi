@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add Product</h5>
            <a href="/admin/product" class="btn btn-danger float-end">Cancel</a>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" placeholder="Modern" name="product_name" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" class="form-control" name="image[]" id="image" multiple required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Price</label>
                            <input type="text" class="form-control" placeholder="50.000" name="price" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Discount</label>
                            <input type="text" class="form-control" placeholder="50%" name="discount" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sold</label>
                            <input type="text" class="form-control" placeholder="" name="sold" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="category">
                                @foreach ($subcategories as $data)
                                <option value="{{$data->id}}">
                                    {{$data->subcategory_name}}&nbsp;-&nbsp;{{$data->category_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row justify-content-center">
                            <img src="{{asset('assets/images/default.png')}}" alt="Preview" id="imagePreview"
                                style="max-width: 300px; margin-top: 10px;">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        var input = document.getElementById('image');
        var preview = document.getElementById('imagePreview');
  
        if (input.files && input.files[0]) {
            var reader = new FileReader();
  
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
  
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection