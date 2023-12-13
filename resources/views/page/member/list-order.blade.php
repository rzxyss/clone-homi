@extends('page.partials.member')
@section('member_content')
<div class="card">
    <div class="card-header">
        <h3>Pesanan Masuk</h3>
    </div>
    <div class="card-body">
        @if ($jumlah_order > 0)
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Foto Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($order as $data)
                    <tr>
                        <th scope="row">{{$no++}}</th>
                        <td>{{$data->name}}</td>
                        <td>{{$data->product_name}}</td>
                        <td><img src="{{asset('assets/images/product/'.$data->image)}}" width="80" /></td>
                        <td>Rp. {{$data->price}}</td>
                        <td>{{$data->discount}}%</td>
                        <td>Rp. 900.000</td>
                        <td>
                            @if ($data->status == 0)
                            <span class="badge badge-warning">Sedang Diverifikasi Oleh Admin</span>
                            @elseif ($data->status == 3)
                            <span class="badge badge-danger">Pesanan Ditolak Oleh Admin, Silahkan Hubungi Admin</span>
                            @elseif ($data->status == 2)
                            <span class="badge badge-info">Sedang Diproses Oleh Admin</span>
                            @else
                            <span class="badge badge-success">Selesai, Admin Telah Mengirimkan File Ke Email
                                Customer</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <h4 class="text-muted text-center">Tidak Ada Pesanan Masuk</h4>
        @endif
    </div>
</div>
@endsection