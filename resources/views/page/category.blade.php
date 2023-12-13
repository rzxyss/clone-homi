@extends('page.partials.main')

@section('title')
{{ $subcategory->subcategory_name }}
@endsection

@push('css')
<style>
   .bg-transparent {
        background-color: transparent
   }

   .scale-transition {
        transition: transform 0.3s ease-in-out; 
        transform-origin: center;
    }

    .scale-transition:hover {
        transform: scale(1.3); 
    }

    .strikethrough-text {
        text-decoration: line-through;
        font-size: 0.8rem;
    }

    .strikethrough-text-font {
        font-size: 0.95rem;
    }

    .bg-brown {
        background-color: rgb(64, 36, 36);
    }

    .bestseller {
        color: dark; 
        font-weight: bold;
        font-size: 16px;
        font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif
    }
</style>
@endpush

@section('contents')

<section class="highlight mt-5 mb-3">
    <h1 class="fashion_taital text-center">
        {{ $category->category_name }}
    </h1>
    <h1 class="fashion_taital text-center" style="color: rgb(64, 36, 36); font-size: 2.25rem">
        '{{ $subcategory->subcategory_name }}'
    </h1>
    <h1 class="text-center mt-5" style="font-size: 2rem">Produk Terlaris</h1>
    @if ($bestseller->isNotEmpty()) 
        <div class="fashion_section_2 container">
            <div class="row col-md-12">
                @foreach ($bestseller as $item)
                    <div class="col-md-4 col-sm-4">
                        <div class="box_main">
                            <a href="{{ route('product.detail', $item->id) }}">
                                <h4 class="shirt_text">
                                    {{ strlen($item->product_name) > 42 ? substr($item->product_name, 0, 42) . '...' : $item->product_name }}
                                </h4>                            
                                <p class="price_text mb-1">
                                    <span class="{{ $item->discount ? 'strikethrough-text strikethrough-text-font' : '' }}" style="color: #262626;">IDR. {{ number_format($item->price, 0, ',', '.'); }}</span>
                                @if ($item->discount)
                                    <strong style="font-size: 1.15rem">{{ number_format($item->price - ($item->price * $item->discount / 100), 0, ',', '.') }}</strong>
                                </p>    
                                    <div class="mt-2"><br></div>
                                @else
                                    <div class="mt-2"><br></div>
                                @endif
                                
                                <div class="box_image" style="background-image: url('{{ asset('assets') }}/images/product/{{ $item->image->image }}')">                            </div>
                            </a>
                            <div class="mt-3">
                                @if($item->discount)
                                    <span style="float: left" class="text-white discount_label"> &nbsp; -{{ $item->discount }}% &nbsp;</span>
                                @endif
                                <div style="text-align:right" class="buy_bt mb-3">
                                    @if ($item->sold >= 1000 && $item->sold < 1000000) 
                                        {{ $item->sold / 1000 . 'k' }}
                                    @elseif ($item->sold >= 1000000) 
                                        {{ $item->sold / 1000000 . 'm' }}
                                    @else 
                                        {{ $item->sold }}
                                    @endif
                                    Sold
                                </div>
                            </div>
                            <div class="btn_main">
                                <div class="buy_bt bestseller">Terlaris<a class="bestseller" href="#"> #{{ $loop->iteration }}</a> </div>
                                <div class="cartDivButton{{ $item->id }}">
                                    <button type="button" onclick="cartToggle({{ $item->id }})" class="scale-transition blue-logo btn btn-link cartButton{{ $item->id }}">
                                        <i class="fa-solid fa-md fa-cart-shopping {{ $item->isCart == 1 ? 'text-success' : 'blue-logo' }} cartIcon{{ $item->id }}"></i>
                                    </button>
                                </div>
                                <div class="likeDivButton{{ $item->id }}}" >
                                    <button type="button" onclick="likeToggle({{ $item->id }})" class="scale-transition btn btn-link {{ $item->isLiked == 1 ? 'text-danger' : 'transparent' }} likeButton{{ $item->id }}">
                                        <i class="{{ $item->isLiked == 1 ? 'fa-solid' : 'fa-regular' }} fa-md fa-heart likeIcon{{ $item->id }}"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="fashion_section_2">
            <h4>Tidak tersedia produk untuk kategori ini</h4>
        </div>
    @endif
</section>


<section id="all-product" class="container my-5">
    <div class="col-lg-12 justify-content-center">
        <h1 class="text-center mb-5" style="font-size: 2rem">Semua Produk</h1>
        <div class="col-md-12">
            <div class="col-md-2 mt-1 d-inline ">
                <h2 class="" style="font-size: 1.2rem; float:left">
                    <i class="fa-solid fa-lg fa-filter"></i>
                    Filter : 
                </h2>   
                <div class="btn-group">
                    <button class="btn btn-sm btn-outline-dark newest"  data-sorttype="newest" onclick="sort(this)">Terbaru</button>
                    <button class="btn btn-sm btn-outline-dark oldest" data-sorttype="oldest" onclick="sort(this)">Terlama</button>
                    <button class="btn btn-sm btn-outline-dark best-seller"  data-sorttype="best-seller" onclick="sort(this)">Terlaris</button>
                    {{-- <div class="dropdown"> --}}
                        <a class="dropdown-toggle btn-sm btn btn-outline-danger" style="font-size: 0.85rem" href="#" role="button" id="dropdownPrice"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Harga
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownPrice">
                            <button class="dropdown-item high-price" data-sorttype="high-price" onclick="sort(this)">Harga Tertinggi</button>
                            <button class="dropdown-item low-price" data-sorttype="low-price" onclick="sort(this)">Harga Terendah</button>
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
    @if ($products->isNotEmpty())
        <div class="fashion_section_2 text-left">
            <div class="row col-lg-12" id="products" >
              
            </div>
        </div>
    @else
        <div class="fashion_section_2">
            <h4>Tidak tersedia produk untuk kategori ini</h4>
        </div>
    @endif
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // document.addEventListener("DOMContentLoaded", () => {
    //     var sortType = 'Newest'
    //     sort(sortType)

    // })
    
    $(document).ready(function() {
        var sortType = 'newest'
        sort(sortType)
    })

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
    }
    
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
        var subcategory = {{ $subcategory->id }}
        selectedSort(sortType)
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: `categories/sort/${subcategory}/${sortType}?page=${page}`, // Include the page parameter in the URL
            success: function (response) {
                if (response) {
                    $("#products").empty();
                    $("#data"+page).empty();

                    $.each(response.products, function (index, value) {
                        var discountLabel = value.discount ? `<span class="text-white discount_label"> &nbsp; -${value.discount}% &nbsp;</span>` : '';   
                        var priceAfterDiscount;
                        if(value.discount) {
                            priceAfterDiscount = `<h5 style="text-decoration:none; font-size:0.95rem; " class="ml-1 p-0 orange-logo">${formatPrice(value.price - (value.price * value.discount / 100))}</h5>`
                        }

                        const soldText = value.sold >= 1000000
                                        ? value.sold / 1000000 + 'm'
                                        : value.sold >= 1000
                                        ? value.sold / 1000 + 'k'
                                        : value.sold;

                        const colorMap = {
                            Vintage: 'bg-brown text-white',
                            Modern: 'bg-info text-white',
                            Skandinavia: 'bg-light text-dark',
                            Classic: 'bg-secondary text-white',
                            default: 'bg-danger text-white',
                        };
                        const bg = colorMap[value.subcategory.subcategory_name] || colorMap.default;

                        var cartToggle = '{{ route("cart.toggle",'+value.id+') }}'
                        var likeToggle = '{{ route("like.toggle",'+value.id+') }}'
                        var cardHtml = `
                            <div class="col-md-3 d-flex justify-content-center">
                                <div class="card mb-4" style="width: 18rem;">
                                    <a href="/produk/${value.id}" class="position-relative">
                                        <span style="z-index:99; font-size:0.75rem" class="p-1 ml-1 mt-1 position-absolute badge badge-notification ${bg}">
                                            ${value.subcategory.subcategory_name}
                                        </span>
                                        <div class="box_image" style="background-image: url('{{ asset('assets') }}/images/product/${value.image.image}')"></div>
                                    </a>
                                    <div class="card-body">
                                        ${discountLabel}
                                        <h4 class="card-title m-0 p-0" style=" line-height: 1rem">${limitString(value.product_name, 33)}</h4>
                                        <div class="d-flex">
                                            <h5 class="mt-1 p-0 text-muted">IDR.</h5>
                                            <h5 class="card-title mt-1 p-0 text-muted ${value.discount ? 'strikethrough-text' : ''}">&nbsp;${formatPrice(value.price)}
                                            </h5>
                                            ${value.discount ? priceAfterDiscount : ''}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="mt-2 mx-3">
                                            <h5>${soldText} Sold</h5>
                                        </span>
                                        <div class="d-flex btn-group" style="float: right;">
                                            <div class="cartDivButton${value.id}">
                                                <button type="button" onclick="cartToggle(${value.id})" class="blue-logo btn btn-link scale-transition cartButton${value.id}">
                                                    <i class="fa-solid fa-md fa-cart-shopping ${value.isCart == 1 ? 'text-success' : 'blue-logo'} cartIcon${value.id}"></i>
                                                </button>
                                            </div>
                                            <div class="likeDivButton${value.id}" >
                                                <button type="button" onclick="likeToggle(${value.id})" class="scale-transition btn btn-link ${value.isLiked == 1 ? 'text-danger' : 'blue-logo'} likeButton${value.id}">
                                                    <i class="fa-${value.isLiked == 1 ? 'solid' : 'regular'} fa-md fa-heart likeIcon${value.id}"></i>
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
                                    <a class="page-link" href="#all-product" onclick="sort(${sortType}, ${response.pagination.current_page - 1})">Previous</a>
                                </li>
                                <li class="page-item ${response.pagination.current_page === response.pagination.last_page ? 'disabled' : ''}">
                                    <a class="page-link" href="#all-product" onclick="sort(${sortType}, ${response.pagination.current_page + 1})">Next</a>
                                </li>
                            </ul>
                        </div>`;

                    $("#products").append(paginationHtml);

                    var paginationHtml = `
                        <div class="d-flex justify-content-end text-end col-lg-12 col-sm-4">
                            <ul class="pagination">
                                <li class="page-item ${response.pagination.current_page === 1 ? 'disabled' : ''}">
                                    <a class="page-link" href="#all-product" onclick="sort('${sortType}', ${response.pagination.current_page - 1})">Previous</a>
                                </li>`;
                    
                    for (let i = 1; i <= response.pagination.last_page; i++) {
                        paginationHtml += `
                            <li class="page-item ${response.pagination.current_page === i ? 'active' : ''}">
                                <a class="page-link" href="#all-product" onclick="sort('${sortType}', ${i})">${i}</a>
                            </li>`;
                    }

                    paginationHtml += `
                                <li class="page-item ${response.pagination.current_page === response.pagination.last_page ? 'disabled' : ''}">
                                    <a class="page-link" href="#all-product" onclick="sort('${sortType}', ${response.pagination.current_page + 1})">Next</a>
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
                        title: 'Kesalahan!',
                        message: response.error,
                        icon: 'fa fa-x fa-sm',
                        closeOnClick: true,
                        position: "topRight",
                    });
                    return false;
                }
                if (response) {
                    $('.likeDivButtonAllProduct'+productId).empty();
                    $('.likeDivButton'+productId).removeClass('scale-transition');

                    var likeButton = `<button type="button" id="likeButton${productId}" onclick="likeToggle(${response.productId})" class="btn btn-link ${response.isLiked == 1 ? 'text-danger' : 'blue-logo'}">
                                            <i class="fa-${response.isLiked == 1 ? 'solid' : 'regular'} fa-md fa-heart"></i>
                                        </button>`;

                    $('.likeDivButtonAllProduct'+productId).append(likeButton);
                    $('.likeDivButton'+productId).addClass('scale-transition');
                    if (response.isLiked == 1) {
                        $('.likeButton'+productId).removeClass('blue-logo').addClass('text-danger');
                        $('.likeIcon'+productId).removeClass('fa-regular').addClass('fa-solid');
                        iziToast.success({
                            title: 'Sukses!',
                            message: response.message,
                            icon: 'fa fa-check',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    } else {
                        $('.likeButton'+productId).removeClass('text-danger').addClass('blue-logo');
                        $('.likeIcon'+productId).removeClass('fa-solid').addClass('fa-regular');
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
                    $('.cartDivButton'+productId).removeClass('scale-transition');
                    $('.cartDivButtonAllProduct'+productId).empty();

                    var cartButton = `<button type="button" onclick="cartToggle(${response.productId})" class="blue-logo btn btn-link">
                                        <i class="fa-solid fa-md fa-cart-shopping ${response.isCart == 1 ? 'text-success' : 'blue-logo'}"></i>
                                    </button>`;

                    $('.cartDivButtonAllProduct'+productId).append(cartButton);

                    $('.cartDivButton'+productId).addClass('scale-transition');
                    if (response.isCart == 1) {
                        $('.cartIcon'+productId).removeClass('blue-logo').addClass('text-success');
                        iziToast.success({
                            title: 'Sukses!',
                            message: response.message,
                            icon: 'fa fa-check',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    } else {
                        $('.cartIcon'+productId).removeClass('text-success').addClass('blue-logo');
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