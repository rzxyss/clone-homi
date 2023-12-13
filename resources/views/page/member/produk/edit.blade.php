@extends('page.partials.member')

@section('member_content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Tambah Produk</h3>
        <a class="btn btn-danger" href="{{route('produk.index')}}">Cancel</a>
    </div>
    <div class="card-body">
        <form action="{{ route('member.produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" placeholder="Modern" name="product_name"
                            value="{{$product->product_name}}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" class="form-control" name="image[]" id="image" multiple />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Price</label>
                        <input type="text" class="form-control" placeholder="50.000" name="price"
                            value="{{$product->price}}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Discount</label>
                        <input type="text" class="form-control" placeholder="50%" name="discount"
                            value="{{$product->discount}}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sold</label>
                        <input type="text" class="form-control" placeholder="" name="sold" value="{{$product->sold}}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sub Category</label>
                        <select class="form-control" name="subcategory">
                            <option selected disabled>Pilih...</option>
                            @foreach ($subcategories as $data)
                            <option value="{{$data->id}}" {{$product->subcategory_id == $data->id ?
                                'selected' : ''}}>{{$data->subcategory_name}}&nbsp;-&nbsp;{{$data->category_name}}
                            </option>
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
                                @foreach ($list_image as $i => $img)
                                <tr>
                                    <td>
                                        <img src="{{ asset('assets/images/product/'.$img->image) }}" height="80" />
                                    </td>
                                    <td>
                                        <form id="deleteimage_{{$i}}"
                                            action="{{ route('member.image.delete', $img->id) }}" method="post">
                                            @csrf
                                            <a href="#"
                                                onclick="event.preventDefault(); document.getElementById('deleteimage_{{$i}}').submit();"
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
@endsection