@extends('page.partials.main')

@section('title')
Detail Produk
@endsection

@push('css')
<style>
    h1 {
        font-size: 2.2rem;
    }

    .scale-transition {
        transition: transform 0.3s ease-in-out;
        transform-origin: center;
    }

    .scale-transition:hover {
        transform: scale(1.5);
    }

    #copyInfo {
        margin-top: 10px;
        padding: 5px;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        border-radius: 5px;
        display: none;
    }
</style>
@endpush

@section('contents')
@php
function formatNumber($number) {
if ($number >= 1000 && $number < 1000000) { return number_format($number / 1000, 1, '.' , '' ) . 'k' ; } elseif
    ($number>= 1000000) {
    return number_format($number / 1000000, 1, '.', '') . 'm';
    } else {
    return $number;
    }
    }

    $views = formatNumber($product->viewers);
    $followers = formatNumber($user->followers);
    $likes = formatNumber($likes);
    @endphp

    <div class="content container-fluid container  mt-5">
        <h1>{{$product->product_name}}</h1>

        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner my-3 text-center">
                @foreach ($image as $i => $img)
                <div class="carousel-item {{$i == 0 ? 'active' : ''}}">
                    <img src="{{asset('assets/images/product/'.$img->image)}}" class="d-block w-100" alt="..."
                        style="width: 300px; height: 400px; object-fit: cover;">
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="d-flex justify-content-between align-items-center p-2 mb-4" style="width: 100%">
            <div class="d-flex flex-row ml-2">
                <div class=""><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="user"
                        class="rounded-circle" width="60" /></div>
                <div class="pl-4">
                    <h3 style="margin-top: 0;">{{ ucfirst($user->name) }}</h3>
                    <h5 id="followers" style="margin-top: -15px;">{{ $followers }} followers</h5>
                    <button id="followButton" onclick="followToggle({{ $user->id }})"
                        class="btn {{ $followStatus ? 'btn-outline-success text-dark' : 'btn-success text-white' }} btn-rounded text-uppercase font-14"
                        style="margin-top: -10px; padding: 5px 10px; font-size: 12px;">
                        <i class="fa fa-plus mr-2"></i>
                        Follow
                    </button>
                    <!-- Elemen untuk menampilkan informasi hasil copy -->
                </div>
            </div>


            <div class="d-flex mr-5">
                <button class="btn btn-link" id="copyButton"><i class="fa fa-share"></i></button>
                <p class="m-1 p-1"><i class="fa-solid fa-eye"></i> {{ $views }}</p>
                <div class="likeDiv{{ $product->id }}">
                    <button type="button" id="likeButton{{ $product->id }}" onclick="likeToggle({{ $product->id }})"
                        class="scale-transition btn btn-link {{ $product->like ? $product->like->is_liked == 1 ? 'text-danger' : 'blue-logo' : 'blue-logo' }}">
                        <i id="likeIcon{{ $product->id }}"
                            class="fa-{{ $product->like ? $product->like->is_liked == 1 ? 'solid' : 'regular' : 'regular'}} fa-md fa-heart"></i>
                        <span id="likes">{{ $likes }}</span>
                    </button>
                </div>
                <div class="cartDiv{{ $product->id }}">
                    <button type="button" id="cartButton{{ $product->id }}" onclick="cartToggle({{ $product->id }})"
                        class="btn btn-link scale-transition">
                        <i id="cartIcon{{ $product->id }}"
                            class="fa-solid fa-md fa-cart-shopping {{ $product->cart ? $product->cart->is_cart == 1 ? 'text-success' : 'blue-logo' : 'blue-logo' }}"></i>
                    </button>
                </div>
            </div>
        </div>
        <div id="copyInfo" class="mb-3" style="display: none;"></div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    // Mengambil tombol dan elemen informasi dari DOM
    var copyButton = document.getElementById('copyButton');
    var copyInfo = document.getElementById('copyInfo');

    // Menambahkan event listener untuk klik tombol
    copyButton.addEventListener('click', function() {
        // Mendapatkan URL saat ini
        var currentUrl = window.location.href;

        // Membuat elemen textarea sementara untuk menyalin teks
        var tempTextarea = document.createElement('textarea');
        tempTextarea.value = currentUrl;

        // Menambahkan elemen textarea ke dalam DOM
        document.body.appendChild(tempTextarea);

        // Memilih dan menyalin teks dari elemen textarea
        tempTextarea.select();
        document.execCommand('copy');

        // Menghapus elemen textarea sementara
        document.body.removeChild(tempTextarea);

        // Menampilkan informasi ke pengguna
        copyInfo.innerText = 'URL berhasil disalin!';
        copyInfo.style.display = 'block';

        // Menyembunyikan informasi setelah beberapa detik
        setTimeout(function() {
            copyInfo.style.display = 'none';
        }, 3000);
    });
});

    </script>
    <script>
        function followToggle(userId) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var route = `{{ route('follow', ':userId') }}`
        var url = route.replace(':userId', userId);
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: url, 
            data: {
                '_token' : csrfToken
            },
            success: function (response) {
                if(response.error) {
                    iziToast.error({
                        title: 'Kesalahan!',
                        message: response.error,
                        icon: 'fa fa-x fa-sm',
                        closeOnClick: true,
                        position: "topRight",
                    });
                    return false;
                }
                if (response) {
                    $('#followers').text(response.totalFollowers)
                    if(response.followStatus == 1) {
                        $('#followButton').removeClass('btn-outline-success text-dark').addClass('btn-success text-white')
                        iziToast.success({
                            title: 'Success!',
                            message: response.message,
                            icon: 'fa fa-check',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    } else {
                        $('#followButton').addClass('btn-outline-success text-dark').removeClass('btn-success text-white')
                        iziToast.info({
                            title: 'Success!',
                            message: response.message,
                            icon: 'fa fa-check',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    }
                }
            },
            error: function(response) {
                iziToast.error({
                    title: 'Kesalahan',
                    message: response.error,
                    icon: 'fa fa-x ',
                    closeOnClick: true,
                    position: "topRight",
                });
            }
        })
    }

    function likeToggle(productId) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var route = `{{ route('like.toggle', ':productId') }}`
        var url = route.replace(':productId', productId);
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: url, 
            data: {
                '_token' : csrfToken
            },
            success: function (response) {
                if(response.error) {
                    iziToast.error({
                        title: 'Kesalahan!',
                        message: response.error,
                        icon: 'fa fa-x fa-sm',
                        closeOnClick: true,
                        position: "topRight",
                    });
                    return false;
                }
                if (response) {
                    $('#likeDiv'+productId).empty();
                    $('#likeButton'+productId).removeClass('scale-transition');

                    var likeButton = `<button type="button" id="likeButton(${productId})" onclick="likeToggle(${productId})" class="btn btn-link">
                                        <i class="fa-md fa-heart"></i>
                                        
                                      </button>`;
                    if(response.isLiked == 1) {
                        $('#likeButton'+productId).removeClass('blue-logo').addClass('text-danger');
                        $('#likeIcon'+productId).removeClass('fa-regular').addClass('fa-solid');
                        $('#likes').text(response.likes)
                    } else {
                        $('#likeButton'+productId).addClass('blue-logo').removeClass('text-danger');
                        $('#likeIcon'+productId).addClass('fa-regular').removeClass('fa-solid');
                        $('#likes').text(response.likes)
                    }
                    $('#likeDiv'+productId).append(likeButton);
                    $('#likeButton'+productId).addClass('scale-transition');
                    if(response.isLiked == 1) {
                        iziToast.success({
                            title: 'Success!',
                            message: response.message,
                            icon: 'fa fa-check',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    } else {
                        iziToast.info({
                            title: 'Sure?',
                            message: response.message,
                            icon: 'fa fa-circle-info',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    }
                }
            },
            error: function(response) {
                iziToast.error({
                    title: 'Kesalahan',
                    message: response.error,
                    icon: 'fa fa-x ',
                    closeOnClick: true,
                    position: "topRight",
                });
            }
        })
    }

    function cartToggle(productId) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var route = `{{ route('cart.toggle', ':productId') }}`
        var url = route.replace(':productId', productId);
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: url, 
            data: {
                '_token' : csrfToken
            },
            success: function (response) {
                if(response.error) {
                    iziToast.error({
                        title: 'Kesalahan!',
                        message: response.error,
                        icon: 'fa fa-x',
                        closeOnClick: true,
                        position: "topRight",
                    });
                    return false;
                }
                if (response) {
                    $('#cartDiv'+productId).empty();
                    $('#cartButton'+productId).removeClass('scale-transition');

                    var cartButton = `<button type="button" id="cartButton${productId}" onclick="cartToggle(${response.productId})" class="btn btn-link scale-transition">
                                         <i class="fa-solid fa-md fa-cart-shopping "></i>
                                      </button>`;
                    if(response.isCart == 1) {
                        $('#cartIcon'+productId).removeClass('blue-logo').addClass('text-success');
                    } else {
                        $('#cartIcon'+productId).addClass('blue-logo').removeClass('text-success');
                    }

                    $('#cartDiv'+productId).append(cartButton);
                    $('#cartButton'+productId).addClass('scale-transition');
                    if(response.isCart == 1) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: response.message,
                            icon: 'fa fa-check',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    } else {
                        iziToast.info({
                            title: 'Yakin?',
                            message: response.message,
                            icon: 'fa fa-circle-info',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    }
                }
            },
            error: function(response) {
                iziToast.error({
                    title: 'Kesalahan',
                    message: response.error,
                    icon: 'fa fa-x',
                    position: "topRight",
                });
            }
        })
    }
    </script>
    @endsection