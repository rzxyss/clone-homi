@extends('page.partials.member')

@section('member_content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Tambah Produk</h3>
        <a class="btn btn-danger" href="{{route('produk.index')}}">Cancel</a>
    </div>
    <div class="card-body">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" placeholder="Modern" name="product_name" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" class="form-control" name="image[]" id="image" multiple />
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
                        <label class="form-label">Sub Category</label>
                        <select class="form-control" name="subcategory">
                            <option selected disabled>Pilih...</option>
                            @foreach ($subcategories as $data)
                            <option value="{{$data->subcategory_name}}&nbsp;-&nbsp;{{$data->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class=" col-md-6">
                                <div id="imagePreviews"></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
</div>
@endsection