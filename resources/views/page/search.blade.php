@extends('page.partials.main')

@section('title')
Search
@endsection

@push('css')
<style>
    .scale-transition {
        transition: transform 0.3s ease-in-out;
        transform-origin: center;
    }

    .scale-transition:hover {
        transform: scale(1.5);
    }

    .strikethrough-text {
        text-decoration: line-through;
        font-size: 0.8rem;
    }
</style>
@endpush

@section('contents')

<div class="container my-5">
    <div class="col-lg-12 justify-content-center">
        <h1 class="text-center mb-5" style="font-size: 2rem">Pencarian Anda</h1>
    </div>
</div>
<div class="container-fluid mb-5">
    <div class="row col-lg-12 mx-2">
        @foreach ($product as $data)
        <div class="col-md-3 d-flex justify-content-center">
            <a href="{{ asset('produk/'.$data->id)}}">
                <div class="card mb-4" style="width: 18rem;">
                    <div class="box_image"
                        style="background-image: url('{{ asset('assets/images/product/'.$data->image) }}">
                    </div>
            </a>

            <div class="card-body">
                {{$data->discount}}
                <h4 class="card-title m-0 p-0" style=" line-height: 1rem">{{$data->product_name}}</h4>
                <div class="d-flex">
                    <h5 class="mt-1 p-0 text-muted">IDR.</h5>
                    <h5 class="card-title mt-1 p-0 text-muted {{$data->discount > 0 ? 'strikethrough-text' : ''}}">
                        &nbsp;{{$data->price}}
                    </h5>
                    {{$data->price}}
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <span class="mt-2 mx-3">
                    <h5>{{$data->sold}} Sold</h5>
                </span>
                <div class="d-flex btn-group" style="float: right;">
                    <div id="cartButton{{$data->id}}">
                        <button type="button" onclick="cartToggle({{$data->id}})"
                            class="scale-transition blue-logo btn btn-link">
                            <i
                                class="fa-solid fa-md fa-cart-shopping ${value.isCart == 1 ? 'text-success' : 'blue-logo'}"></i>
                        </button>
                    </div>
                    <div id="likeButton{{$data->id}}">
                        <button type="button" onclick="likeToggle({{$data->id}})"
                            class="scale-transition btn btn-link ${value.isLiked == 1 ? 'text-danger' : 'blue-logo'}">
                            <i class="fa-${value.isLiked == 1 ? 'solid' : 'regular'} fa-md fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function likeToggle(productId) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: `like-toggle/${productId}`, 
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
                    $('#likeButton'+productId).empty();
                    $('#likeButton'+productId).removeClass('scale-transition');

                    var likeButton = `<button type="button" id="likeButton${productId}" onclick="likeToggle(${response.productId})" class="btn btn-link ${response.isLiked == 1 ? 'text-danger' : 'blue-logo'}">
                                        <i class="fa-${response.isLiked == 1 ? 'solid' : 'regular'} fa-md fa-heart"></i>
                                      </button>`;

                    $('#likeButton'+productId).append(likeButton);
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
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: `cart-toggle/${productId}`, 
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
                    $('#cartButton'+productId).empty();
                    $('#cartButton'+productId).removeClass('scale-transition');

                    var cartButton = `<button type="button" onclick="cartToggle(${response.productId})" class="blue-logo btn btn-link">
                                          <i class="fa-solid fa-md fa-cart-shopping ${response.isCart == 1 ? 'text-success' : 'blue-logo'}"></i>
                                      </button>`;

                    $('#cartButton'+productId).append(cartButton);
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