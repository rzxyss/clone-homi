@extends('page.partials.main')

@section('title')
Katalog
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

{{-- Content Here --}}
<div class="container my-5">
    <div class="col-lg-12 justify-content-center">
        <h1 class="text-center mb-5" style="font-size: 2rem">Barang yang Disukai</h1>
        <div class="col-md-12">
            <div class="col-md-2 mt-1 d-inline ">
                <h2 class="" style="font-size: 1.2rem; float:left">
                    <i class="fa-solid fa-lg fa-filter"></i>
                    Filter : 
                </h2>   
                <div class="btn-group">
                    <button class="btn btn-sm btn-outline-dark newest" data-sorttype="newest" onclick="sort(this)">Terbaru</button>
                    <button class="btn btn-sm btn-outline-dark oldest" data-sorttype="oldest" onclick="sort(this)">Terlama</button>
                    <button class="btn btn-sm btn-outline-dark best-seller" data-sorttype="best-seller" onclick="sort(this)">Terlaris</button>
                
                    <div class="btn-group">
                        <button class="btn btn-sm btn-outline-danger dropdown-toggle" id="dropdownPrice" style="font-size: 0.85rem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Harga
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownPrice">
                            <button class="dropdown-item high-price" data-sorttype="high-price" onclick="sort(this)">Harga Tertinggi</button>
                            <button class="dropdown-item low-price" data-sorttype="low-price" onclick="sort(this)">Harga Terendah</button>
                        </div>
                    </div>
                
                    {{-- <div class="btn-group">
                        <button class="btn btn-sm btn-outline-info dropdown-toggle" id="dropdownCategory" style="font-size: 0.85rem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Kategori
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownCategory">
                            <button class="dropdown-item modern" data-sorttype="modern" onclick="sort(this)">Modern</button>
                            <button class="dropdown-item vintage" data-sorttype="vintage" onclick="sort(this)">Vintage</button>
                            <button class="dropdown-item skandinavian" data-sorttype="skandinavian" onclick="sort(this)">Skandinavian</button>
                            <button class="dropdown-item tropis" data-sorttype="tropis" onclick="sort(this)">Tropis</button>
                            <button class="dropdown-item klasik" data-sorttype="klasik" onclick="sort(this)">Klasik</button>
                        </div>
                    </div> --}}
                </div>
                
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mb-5">
    <div class="row col-lg-12 mx-2" id="products">
        {{-- @foreach ($products as $data)
            <div class="col-md-3 d-flex justify-content-center">
                <div class="card mb-4" style="width: 18rem;">
                    <div class="box_image" style="background-image: url('{{ asset('assets') }}/images/product/{{ $data->image }}')"></div>
                    <div class="card-body">
                        @if ($data->discount)
                            <span class="text-white discount_label"> &nbsp; - {{ $data->discount }} % &nbsp;</span>
                        @endif
                        <h4 class="card-title m-0 p-0" style=" line-height: 1rem">{{$data->product_name}}</h4>
                        <h5 class="card-title mt-1 p-0 text-muted">Rp. {{number_format($data->price, 0, ',', '.')}}</h5>
                            <div class="d-flex justify-content-between">
                            <span class="mt-2">
                                <h5>{{ $data->sold >= 1000 ? $data->sold / 1000 . 'k' : $data->sold }} Terjual</h5>
                            </span>
                            <div class="d-flex ml-2" style="float: right">
                                <form action="{{ route('cart.toggle', $data->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link">
                                        <i class="fa-solid fa-md fa-cart-shopping"></i>
                                    </button>
                                </form>
                                <form action="{{ route('like.toggle', $data->id) }}" method="POST">
                                    @csrf
                                    @if ($data->isLiked)
                                        <button type="submit" class="btn btn-link" style="color: red;">
                                            <i class="fa-solid fa-md fa-heart"></i>
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-link" >
                                            <i class="fa-regular fa-md fa-heart"></i>
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach --}}
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function selectedSort(sortType) {
        $('.newest, .oldest, .best-seller, .high-price, .low-price').removeAttr('style');
        
        $('#dropdownPrice').removeClass('bg-outline-danger bg-danger text-light');
        // $('#dropdownCategory').removeClass('bg-outline-danger bg-danger text-light');

        $(`.${sortType}`).css({
            'background-color': '#f26522',
            'color': 'white'
        });

        if (sortType === 'newest' || sortType === 'oldest' || sortType === 'best-seller') {
            $('#dropdownPrice').addClass('bg-outline-danger');
        } else if (sortType === 'high-price' || sortType === 'low-price') {
            $('#dropdownPrice').addClass('bg-danger text-light');
        } 
        // else if (sortType === 'modern' || sortType === 'vintage' || sortType === 'skandinavian' || sortType === 'tropis' || sortType === 'klasik') {
        //     $('#dropdownCategory').addClass('bg-info text-light');
        // }
    }

     $(document).ready(function() {
        var sortType = 'newest'
        sort(sortType)
    })
    
    function formatPrice(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function limitString(str, limit) {
        if (str.length > limit) {
            return str.substring(0, limit) + "...";
        } else {
            return str;
        }
    }
    

    function sort(button, page = 1) {
        var sortType = $(button).data('sorttype');
        var url = `liked-product/sort/${sortType}?page=${page}`
        selectedSort(sortType)
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: url, 
            success: function (response) {
                if (response) {
                    $("#products").empty();
                    $("#data"+page).empty();

                    $.each(response.product, function (index, value) {
                        var discountLabel = value.discount ? `<span class="text-white discount_label"> &nbsp; -${value.discount}% &nbsp;</span>` : '';
                        var priceAfterDiscount;
                        if(value.discount) {
                            priceAfterDiscount = `<h5 style="text-decoration:none; font-size:0.95rem; " class="ml-1 p-0 orange-logo">${formatPrice(value.price - (value.price * value.discount / 100))}</h5>`
                        }

                        var soldText;
                        if (value.sold >= 1000 && value.sold < 1000000) {
                            soldText =  value.sold / 1000 + 'k';
                        } else if (value.sold >= 1000000) {
                            soldText =  value.sold / 1000000 + 'm';
                        } else {
                            soldText = value.sold
                        }
                        var cardHtml = `
                            <div class="col-md-3 d-flex justify-content-center">
                                <div class="card mb-4" style="width: 18rem;">
                                    <div class="box_image" style="background-image: url('{{ asset('assets') }}/images/product/${value.image}"></div>
                                    <div class="card-body">
                                        ${discountLabel}
                                        <h4 class="card-title m-0 p-0" style=" line-height: 1rem">${limitString(value.product_name, 36)}</h4>
                                        <div class="d-flex">
                                            <h5 class="mt-1 p-0 text-muted">IDR.</h5>
                                            <h5 class="card-title mt-1 p-0 text-muted ${value.discount ? 'strikethrough-text' : ''}">&nbsp;${formatPrice(value.price)}
                                            </h5>
                                            ${value.discount ? priceAfterDiscount : ''}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between" >
                                        <span class="mt-2 mx-3">
                                            <h5>${soldText} Sold</h5>
                                        </span>
                                        <div class="d-flex btn-group" style="float: right;">
                                            <div id="cartButton${value.id}">
                                                <button type="button" onclick="cartToggle(${value.id})" class="blue-logo btn btn-link">
                                                    <i class="fa-solid fa-md fa-cart-shopping ${value.isCart == 1 ? 'text-success' : 'blue-logo'}"></i>
                                                </button>
                                            </div>
                                            <div id="likeButton${value.id}" >
                                                <button type="button" onclick="likeToggle(${value.id})" class="scale-transition btn btn-link ${value.isLiked == 1 ? 'text-danger' : 'blue-logo'}">
                                                    <i class="fa-${value.isLiked == 1 ? 'solid' : 'regular'} fa-md fa-heart"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                        $("#products").append(cardHtml);
                    });
                        
                    var paginationHtml = `
                        <div id="pagination" class="d-flex justify-content-end text-end col-lg-12 col-sm-4">
                            <ul class="pagination">
                                <li class="page-item ${response.pagination.current_page === 1 ? 'disabled' : ''}">
                                    <a class="page-link" href="#" onclick="sort(${sortType}, ${response.pagination.current_page - 1})">Previous</a>
                                </li>
                                <li class="page-item ${response.pagination.current_page === response.pagination.last_page ? 'disabled' : ''}">
                                    <a class="page-link" href="#" onclick="sort(${sortType}, ${response.pagination.current_page + 1})">Next</a>
                                </li>
                            </ul>
                        </div>`;

                    $("#products").append(paginationHtml);

                    var paginationHtml = `
                        <div class="d-flex justify-content-end text-end col-lg-12 col-sm-4">
                            <ul class="pagination">
                                <li class="page-item ${response.pagination.current_page === 1 ? 'disabled' : ''}">
                                    <a class="page-link" href="#" onclick="sort('${sortType}', ${response.pagination.current_page - 1})">Previous</a>
                                </li>`;
                    
                    for (let i = 1; i <= response.pagination.last_page; i++) {
                        paginationHtml += `
                            <li class="page-item ${response.pagination.current_page === i ? 'active' : ''}">
                                <a class="page-link" href="#" onclick="sort('${sortType}', ${i})">${i}</a>
                            </li>`;
                    }

                    paginationHtml += `
                                <li class="page-item ${response.pagination.current_page === response.pagination.last_page ? 'disabled' : ''}">
                                    <a class="page-link" href="#" onclick="sort('${sortType}', ${response.pagination.current_page + 1})">Next</a>
                                </li>
                            </ul>
                        </div>`;

                    $("#pagination").html(paginationHtml);
                }
            }
        });
    }

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
                        title: 'Error!',
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
                            message: response.success,
                            icon: 'fa fa-check',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    } else {
                        iziToast.info({
                            title: 'Sure?',
                            message: response.success,
                            icon: 'fa fa-circle-info',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    }
                }
            },
            error: function(response) {
                iziToast.success({
                    title: 'Failed',
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
                        title: 'Error!',
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
                            title: 'Success!',
                            message: response.success,
                            icon: 'fa fa-check',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    } else {
                        iziToast.info({
                            title: 'Sure?',
                            message: response.success,
                            icon: 'fa fa-circle-info',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    }
                }
            },
            error: function(response) {
                iziToast.error({
                    title: 'Failed',
                    message: response.error,
                    icon: 'fa fa-x',
                    position: "topRight",
                });
            }
        })
    }
    
</script>
@endsection

