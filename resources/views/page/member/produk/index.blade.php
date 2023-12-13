@extends('page.partials.member')

@section('member_content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Produk Saya</h3>
        <a class="btn btn-link" href="{{route('produk.create')}}">Tambah</a>
    </div>
    <div class="card-body">

        @if ($jumlah_produk > 0)
        <div class="table-responsive">
            <table id="myTable" class="table display">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Foto Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Jumlah View</th>
                        <th scope="col">Jumlah Like</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($products as $data)
                    <tr>
                        <th scope="row">{{$no++}}</th>
                        <th scope="row">{{$data->product_name}}</th>
                        <td>
                            <img src="{{ asset('assets/images/product/'.$data->image) }}" width="80" />
                        </td>
                        <td>Rp. {{number_format($data->price, 0, ',', '.')}}</td>
                        <td>{{$data->discount}}%</td>
                        <td>{{$data->viewers}}</td>
                        <td>0</td>
                        <td>
                            @if ($data->approve == 0)
                            <span class="badge badge-warning">Menunggu Persetujuan</span>
                            @elseif ($data->approve == 2)
                            <h6 style="color: black; font-size: 14px">Permintaan Telah Diterima Oleh Admin, Silahkan
                                Buka
                                Email Anda Untuk
                                Membaca Syarat Dan
                                Ketentuan Yang Berlaku</h6>
                            @elseif ($data->approve == 3)
                            <h6 style="color: black; font-size: 14px">Permintaan Telah Tolak Oleh Admin, Silahkan
                                Buka
                                Email Anda Untuk
                                Mengetahui Alasan Admin Menolak Produk Anda, Lalu Perbaiki Produk Anda</h6>
                            @elseif ($data->approve == 3)
                            @else
                            <span class="badge badge-success">Terupload</span>
                            @endif
                        </td>
                        <td>
                            @if ($data->approve == 2)
                            <form action="{{route('produk.accept', $data->id)}}" method="POST"
                                onsubmit="return konfirmasi()">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm text-white">Terima</button>
                            </form>
                            @elseif($data->approve == 3)
                            <a href="{{route('member.produk.edit', $data->id)}}"
                                class="btn btn-info btn-sm text-white">Edit</a>
                            @elseif ($data->approve == 1)
                            <a class="btn btn-danger btn-sm">Delete</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <h4 class="text-muted text-center">Belum Ada Produk Yang Diupload</h4>
        @endif
    </div>
</div>

<script>
    function konfirmasi() {
        return confirm("Apakah Anda Sudah Membaca Dan Menyetujui Syarat Dan Ketentuan Yang Di Kirimkan Ke Email Anda?");
    }
</script>
@endsection