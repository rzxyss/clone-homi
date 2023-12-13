@extends('page.partials.member')

@section('member_content')
<div class="card">
    <div class="card-header">
        <h3>Pesanan Saya</h3>
    </div>
    <div class="card-body">
        @if ($jumlah_order > 0)
        @foreach ($order as $data)
        @php
        $diskon = ($data->discount/100) * $data->price;
        $total = $data->price - $diskon;
        @endphp
        <div class="row">
            <div class="col-3">
                <img src="{{asset('assets/images/product/'.$data->image)}}" />
            </div>
            <div class="col-9">
                <h3 class="p-0 m-0">{{$data->product_name}}</h3>
                <h3 class="p-0 m-0">{{$total}}</h3>
                <h3 class="p-0 m-0">
                    @if ($data->status == 1)
                    <span class="badge badge-success">Pembelian Disetujui Oleh Admin</span>
                    @else
                    <span class="badge badge-warning">Menunggu Persetujuan Penjual</span>
                    @endif
                </h3>
                <h3 class="p-0 m-0">
                    @if ($data->status == 1)
                    <a href="{{route('download', $data->product_id)}}" class="btn btn-info">Download Desain</a>
                    @endif
                </h3>
            </div>
        </div>
        <div class="line p-2 m-2"></div>
        @endforeach
        @else
        <h4 class="text-muted text-center">Belum Ada Barang Yang Dipesan</h4>
        @endif
    </div>
</div>
@endsection