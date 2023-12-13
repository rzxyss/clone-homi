@extends('page.partials.main')
@push('css')
<style>
    .scale-transition {
        transition: transform 0.3s ease-in-out;
        transform-origin: center;
    }

    .scale-transition:hover {
        transform: scale(1.5);
    }

    .galery-photo {
        position: relative;
        overflow: hidden;
    }

    .galery-photo img {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 8px;
        transition: transform 0.5s;
    }

    .galery-layer {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 10px;
        box-sizing: border-box;
        opacity: 0;
        border-radius: 8px;
        transition: opacity 0.3s ease;
    }

    .galery-layer h3 {
        color: #fff;
    }

    .galery-photo:hover .galery-layer {
        transition: all .5s ease-in-out;
        transform: translateY(-25px);
        color: #fff;
        opacity: 1;
    }
</style>
@endpush

@section('contents')
<div class="container mt-3 mb-3">
    <div class="row ">
        <div class="col-md-7 mt-4">
            <div class="card">
                <div class="card-header">
                    <h3>Informasi</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('checkout.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" disabled value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" disabled value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" class="form-control" disabled value="{{$user->phone}}">
                        </div>
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <select class="form-control" name="bank" id="transfer-info" required>
                                <option value="" selected disabled>Pilih..</option>
                                @foreach ($rekening as $data)
                                <option value="{{$data->bank}}" data-norek="{{ $data->no_rek }}"
                                    data-bank="{{ $data->bank . ' A.N ' . $data->atas_nama }}"> {{$data->bank}} -
                                    {{$data->no_rek}} AN.{{$data->atas_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group rekening alert-info p-2">
                            <h1 class="p-0 m-0" id="norek">-</h1>
                            <h3 class="p-0 m-0" id="atasNama">-</h3>
                            <label>Silahkan Tranfer Ke Rekening Diatas Lalu Screenshoot Bukti Transfer</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bukti Pembayaran</label>
                                    <input type="file" class="form-control" name="proof" id="proof" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 mt-2 row justify-content-center">
                                <img id="preview" src="{{asset('assets/images/default_atm.png')}}" width="200"
                                    alt="Preview Gambar" class="img-preview img-fluid">
                            </div>
                        </div>
                        <div class="private">
                        </div>
                        <button class="btn btn-success">Buat Pesanan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5 mt-4">
            <div class="card">
                <div class="card-header">
                    <h3>List Pembelian Produk</h3>
                </div>
                <div class="card-body">
                    @php
                    $subtotal = 0;
                    @endphp
                    @foreach ($produk as $data)
                    @php
                    $diskon = ($data->discount / 100) * $data->price;
                    $total = $data->price - $diskon;
                    $subtotal += $total;
                    @endphp
                    <div class="border p-2 d-flex align-items-start my-1">
                        <img src="{{asset('assets/images/product/'.$data->image)}}" width="150" class="m-2">
                        <div class="mx-1">
                            <h4 class="p-0 m-0">{{$data->product_name}}</h4>
                            <h4 class="p-0 m-0">Rp. {{number_format($total, 0, ',', '.')}}</h4>
                        </div>
                    </div>
                    @endforeach
                    <div class="pt-2">
                        <h3>Subtotal : Rp. {{number_format($subtotal, 0, ',', '.')}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function previewImage(event) {
      var input = event.target;
      var preview = document.getElementById('preview');

      var reader = new FileReader();

      reader.onload = function() {
        preview.src = reader.result;
      };

      reader.readAsDataURL(input.files[0]);
    }
</script>
<script>
    $('#transfer-info').change(function () {
        var selectedOption = $(this).find(':selected');
        var norek = selectedOption.data('norek');
        var bank = selectedOption.data('bank');

        $('#norek').text(norek);
        $('#atasNama').text(bank);
    });

    $('#proof').change(function () {
        $('#contoh').empty()
        const image = document.querySelector('#proof');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        };
    });
</script>
@endsection