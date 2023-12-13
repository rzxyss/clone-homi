@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add Product</h5>
            <a href="/admin/product" class="btn btn-danger float-end">Cancel</a>
        </div>
        <div class="card-body">
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input value="{{ old('product_name', $product->product_name) }}" type="text"
                                class="form-control" placeholder="Modern" name="product_name" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" class="form-control" name="image[]" id="image" multiple />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Price</label>
                            <input value="{{ old('price', $product->price) }}" type="text" class="form-control"
                                placeholder="50.000" name="price" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Discount</label>
                            <input value="{{ old('discount', $product->discount) }}" type="text" class="form-control"
                                placeholder="50%" name="discount" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sold</label>
                            <input value="{{ old('sold', $product->sold) }}" type="text" class="form-control"
                                placeholder="" name="sold" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="category">
                                @foreach ($subcategories as $data)
                                <option value="{{$data->id}}" {{$data->id == old('category_id',
                                    $product->subcategory_id) ? 'selected' :
                                    ''}}>{{$data->subcategory_name}}&nbsp;-&nbsp;{{$data->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Thumbnail
                            </div>
                            <div class="card-body">
                                <img src="{{ asset('assets/images/product/'.$thumbnail->image) }}"
                                    style="max-width: 300px;" />
                            </div>
                            <div class="card-header">
                                List Image
                            </div>
                            <div class="card-body">
                                <table>
                                    @foreach ($image as $data)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('assets/images/product/'.$data->image) }}" height="80" />
                                        </td>
                                        <td>
                                            <form id="deleteimage" action="{{ route('image.delete', $data->id) }}"
                                                method="post">
                                                @csrf
                                                <a href="#"
                                                    onclick="event.preventDefault(); document.getElementById('deleteimage').submit();"
                                                    class="mx-1 btn btn-custom"><i class="bx bx-trash me-1"></i>
                                                    Delete</a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
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