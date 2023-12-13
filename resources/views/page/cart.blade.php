@extends('page.partials.main')

@section('title')
Keranjang
@endsection

<style>
    #table {
        width: 100% !important
    }
</style>

@section('contents')

{{-- Content Here --}}
<h1 class="text-center mt-5 mb-4" style="font-size: 2rem">Keranjang</h1>
<div class="container mb-5">
    <form action="{{ route('cart.checkout') }}" method="post">
        @csrf
        <table id="table" style="width: 100%" class="table table-responsive dt-responsive table-hover">
            <thead>
                <th class="text-center ">
                </th>

                <th class="text-center col-md-10 col-sm-10">
                    Produk
                </th>

                <th class="text-center col-md-12 col-sm-12">
                    Harga
                </th>

                <th class="text-center col-md-4 col-sm-4">
                    Diskon
                </th>

                <th class="text-center col-md-12 col-sm-12">
                    Subtotal
                </th>

                <th class="text-center col-md-12 col-sm-12">
                    Aksi
                </th>
            </thead>
            @if ($total_data)
            <tbody>
                @foreach ($cart as $item)
                <span class="d-none">
                    @php
                    $product = $item;
                    $subtotal = $product->price - ($product->discount * $product->price / 100);
                    $total += $subtotal;
                    @endphp
                </span>
                <tr>
                    <td>
                        <div class="col-sm-12 col-lg-12 mb-3">
                            <input type="checkbox" class="choose" value="{{$product->id}}" name="selected_product[]"
                                data-subtotal="{{ $subtotal }}" data-id="{{ $product->id }}">
                        </div>
                    </td>

                    <td>
                        <div class="col-sm-12 col-lg-10 mb-3">
                            <a href="{{ url('/produk', $product->id) }}" class="">
                                <div class="media text-left">
                                    <img src="{{asset('assets/images/product/'.$product->image)}}" width="180"
                                        class="mr-3">
                                    <div class="media-body text-dark">
                                        {{ $product->product_name }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </td>

                    <td>
                        <div class="col-sm-12 col-lg-12 text-center mb-3 ">
                            <h4 class="text-website">Rp. {{ number_format($product->price, 0, ',', '.') }}</h4>
                        </div>
                    </td>

                    <td>
                        <div class="col-sm-12 col-lg-12 text-center mb-3">
                            <h3 class="text-website">
                                @if ($product->discount < 50) <span class="badge text-white bg-blue-logo">{{
                                    $product->discount }} %</span>
                                    @elseif ($product->discount < 76) <span class="badge text-white bg-orange-logo">{{
                                        $product->discount }} %</span>
                                        @else
                                        <span class="badge text-white bg-danger">{{ $product->discount }} %</span>
                                        @endif
                            </h3>
                        </div>
                    </td>

                    <td>
                        <div class="col-sm-12 col-lg-12 text-center mb-3">
                            <h4 class="text-website orange-logo">Rp. {{ number_format(($subtotal), 0, ',', '.') }}</h4>
                        </div>
                    </td>

                    <td>
                        <div class="col-sm-12 col-lg-12 mb-3">
                            {{-- <form action="{{ route('cart.destroy', $product->id) }}" method="POST" id="formDelete">
                                @csrf
                                @method('delete')
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('formDelete').submit();"
                                    id="buttonDelete" class="b text-website">Hapus</a>
                            </form> --}}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @endif
        </table>


        <div class="card card-body shadow-sm col-lg-12">
            <div class="row ">
                <div class="col-sm-12 col-lg-5 " style="font-size: 0.95rem">
                    <input type="checkbox" name="" id="choose-all" data-total="{{ $total }}"> Pilih Semua
                </div>
                <div class="col-sm-12 col-lg-4 text-right">
                    <h4>
                        <span class="text-muted">Total Pesanan:</span>
                        <span class="text-website orange-logo total" id="total-price" style="font-size: 1.1rem;">Rp.
                            0</span>
                    </h4>
                </div>
                <div class="col-sm-12 col-lg-3">
                    <button type="submit" class="data-mdb-ripple-init btn btn-block text-dark bg-orange-logo disabled"
                        id="checkout" disabled>Checkout</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

<script>
    $('#tablse').DataTable({
        searching: false,
        processing: false,
        autowidth: true,
        language: {
            emptyTable: "Tidak Ada Data"
        }
    });

    function formatPrice(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    var totalArray = [];
    var saveTotalArray = [];
    var checkedProductId = [];

    $('#buttonDelete').on('click', function() {
        iziToast.question({
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: 'Yakin',
            message: 'Menghapus Produk dari keranjang anda?',
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>', function (instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    $('#formDelete').submit()
                }, true],
                ['<button>NO</button>', function (instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    return false;
                }],
            ],
            onClosing: function(instance, toast, closedBy){
                console.info('Closing | closedBy: ' + closedBy);
            },
            onClosed: function(instance, toast, closedBy){
                console.info('Closed | closedBy: ' + closedBy);
            }
        });
    })

    // $('#checkout').on('click', function() {
    //     var route = "{{ route('cart.checkout') }}"
    //     $('.valueProductId').val(checkedProductId)

    //     $('#formCheckout').attr('action', route)
    //     $('#formCheckout').submit()
    // })


    $('#choose-all').on('click', function(){
        var chooseButton = $('[class=choose]:not(:disabled)');
        var total = 0;
        if (chooseButton.prop('checked')) {
            chooseButton.prop('checked', false);
            if ($('.choose:checked').length === 0) {
                $('#choose-all').prop('checked', false);
                $('#checkout').attr('disabled', true).addClass('text-dark disabled').removeClass('text-white')
            }
            total = 0;
            totalArray = []
            saveTotalArray = []
            checkedProductId = []
        } else {
            chooseButton.prop('checked', true);
            chooseButton.each(function() {
                var subtotal = $(this).data('subtotal');
                var savetotal = $(this).data('savetotal');
                var productId = $(this).data('id');
                totalArray.push(subtotal)
                saveTotalArray.push(savetotal)
                checkedProductId.push(productId)
            });
            if ($('.choose:checked').length !== 0) {
                $('#choose-all').prop('checked', true);
                $('#checkout').removeAttr('disabled').removeClass('text-dark disabled').addClass('text-white')

            }
            saveTotal = calculateSaveTotal();
            total = calculateTotal();
        }
        // console.log(checkedProductId);

        var formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        });

        $('#total-price').text(formatter.format(total));
    });
    $('.choose').on('click', function(){
        var subtotal = $(this).data('subtotal');
        var savetotal = $(this).data('savetotal');
        var productId = $(this).data('id');
        var total, saveTotal = 0;
        if ($(this).prop('checked')) {
            totalArray.push(subtotal);
            saveTotalArray.push(savetotal);
            checkedProductId.push(productId);
        } else {
            var indexTotal = totalArray.indexOf(subtotal);
            var indexSaveTotal = saveTotalArray.indexOf(savetotal);
            var indexProductId = checkedProductId.indexOf(productId);
            if (indexTotal !== -1) {
                totalArray.splice(indexTotal, 1);
            }
            if (indexSaveTotal !== -1) {
                saveTotalArray.splice(indexSaveTotal, 1);
            }
            if (indexProductId !== -1) {
                checkedProductId.splice(indexProductId, 1);
            }
        }
        if ($('.choose:checked').length === 0) {
            $('#checkout').attr('disabled', true).addClass('text-dark disabled').removeClass('text-white')
            $('#choose-all').prop('checked', false);
        } else {
            $('#checkout').removeAttr('disabled').removeClass('text-dark disabled').addClass('text-white')
        }
        var allChecked = $('.choose').length === $('.choose:checked').length;
        $('#choose-all').prop('checked', allChecked);

        saveTotal = calculateSaveTotal();
        total = calculateTotal();
        var formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        });
        $('#total-price').text(formatter.format(total));
    });

    function calculateTotal() {
        if ($('#choose-all').prop('checked')) {
            return totalArray.reduce(function(acc, current) {
                return acc + current;
            }, 0);
        } else {
            return totalArray.reduce(function(acc, current) {
                return acc + current;
            }, 0);
        }
    }

    function calculateSaveTotal() {
        if ($('#choose-all').prop('checked')) {
            return saveTotalArray.reduce(function(acc, current) {
                return acc + current;
            }, 0);
        } else {
            return saveTotalArray.reduce(function(acc, current) {
                return acc + current;
            }, 0);
        }
    }
</script>
@endsection