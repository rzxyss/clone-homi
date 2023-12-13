@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header justify-content-between">
            <div class="d-flex align-items-center justify-content-between">
                <h3>Member Product</h3>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table id="example" class="table">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Member Name</th>
                        <th>Member Phone</th>
                        <th>Member Email</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Status</th>
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
                        <td>{{$data->name}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->product_name}}</td>
                        <td>
                            <img src="{{ asset('assets/images/product/'.$data->image_path) }}" height="80" />
                        </td>
                        <td>Rp {{$data->price}}</td>
                        <td>{{$data->subcategory_name}}</td>
                        <td>{{$data->approve}}</td>
                        <td>
                            <div class="d-flex">
                                <button data-id="{{$data->id}}" class="mx-1 btn btn-custom product-accept">
                                    Accept
                                </button>
                                <button data-id="{{$data->id}}" class="mx-1 btn btn-custom product-denied">
                                    Denied
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="productAccept" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Accept Member Upload</h5>
            </div>
            <form id="formProductaccept" method="POST">
                <div class="modal-body row justify-content-center">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Syarat Dan Ketentuan</label>
                        <textarea type="text" name="syarat" id="syarat_dan_ketentuan" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="productDenied" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Denied Member Upload</h5>
            </div>
            <form id="formProductdenied" method="POST">
                <div class="modal-body row justify-content-center">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Alasan Menolak Upload Member</label>
                        <input type="text" name="alasan" id="input_alasan" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.product-accept').click(function(){
            var id = $(this).data('id');
            $('#productAccept').modal('show');
            $('#formProductaccept').attr('action', '/admin/accept-product/' + id);
        })
        $('.product-denied').click(function(){
            var id = $(this).data('id');
            $('#productDenied').modal('show');
            $('#formProductdenied').attr('action', '/admin/denied-product/' + id);
        })
    });
</script>
@endsection