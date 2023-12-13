@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header justify-content-between">
            <div class="d-flex align-items-center justify-content-between">
                <h3>Product</h3>
                <a href="product/create" class="btn btn-outline-dark">Add New</a>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table id="example" class="table">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($products as $data)
                    <tr>
                        <td><strong>{{$no++}}</strong></td>
                        <td>
                            <img src="{{ asset('assets/images/product/'.$data->image) }}" height="80" />
                        </td>
                        <td>{{$data->product_name}}</td>
                        <td>Rp {{$data->price}}</td>
                        <td>{{$data->discount}}%</td>
                        <td>{{$data->subname}}</td>
                        <td>
                            <div class="d-flex">
                                <form action="{{ route('product.destroy', $data->id) }}" method="post">
                                    <a href="{{ route('product.edit', $data->id) }}" class="mx-1"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mx-1 btn btn-custom"><i class="bx bx-trash me-1"></i>
                                        Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection