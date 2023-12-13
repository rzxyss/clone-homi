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
<div class="banner_bg_main">
    <div class="banner_section layout_padding">
        <div class="container">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 class="banner_taital">Get Start <br>Your favorit shoping</h1>
                                <div class="buynow_bt"><a href="#fashion_section">Buy Now</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 class="banner_taital">Get Start <br>Your favriot shoping</h1>
                                <div class="buynow_bt"><a href="#fashion_section">Buy Now</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 class="banner_taital">Get Start <br>Your favriot shoping</h1>
                                <div class="buynow_bt"><a href="#fashion_section">Buy Now</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@section('contents')
<div class="container mt-3">
    <div class="row mb-2">
        <div class="col-12 text-center pt-3">
        </div>
    </div>

    <h1 class="fashion_taital text-center my-2 mt-1">
        Produk Terbaru Kami
    </h1>

    <!--Start code-->
    <div class="row container">
        <div class="col-12 pb-5 mt-4">
            @if ($jumlah_produk > 0)

                @if($heroArsitektur != NULL)
                <h1>Desain Arsitektur</h1>
                    <section class="row" id="category">
                        <div class="col-12 col-md-6 pb-0 pb-md-3 pt-2 pr-md-1">
                            <div id="featured" class="carousel slide carousel" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="card border-0 rounded-0 text-light overflow zoom">
                                            <div class="position-relative">
                                               
                                               
                                                <div class="ratio_left-cover-1 image-wrapper">
                                                    <a href="{{route('product.detail', $heroArsitektur->id)}}">
                                                        <img class="img-fluid w-100"
                                                            src="{{asset('assets/images/product/'.$heroArsitektur->image->image)}}" alt="#">
                                                    </a>
                                                   
                                                </div>
                                                
                                                
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <!-- category -->
                                                    <a class="p-1 badge badge-primary rounded-0" href="{{ route('categories.index', ['subcategory_name' => $heroArsitektur->subcategory->subcategory_name] ) }}">
                                                        {{ $heroArsitektur->subcategory->subcategory_name }}
                                                    </a>

                                                    <!--title-->
                                                    <a href="{{route('product.detail', $heroArsitektur->id)}}">
                                                        <h2 class="h5 text-white my-1">
                                                            {{ $heroArsitektur->product_name }}
                                                        </h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end item slider-->
                                </div>
                                <!--end carousel inner-->
                            </div>
                        </div>
                        <!--End slider news-->

                        <!--Start box news-->
                        <div class="col-12 col-md-6 pt-2 pl-md-1 mb-3 mb-lg-4">
                            <div class="row">
                                @foreach ($arsitektur as $data)
                                    <div class="col-6 pb-1 pt-0 pr-1">
                                        <div class="card border-0 rounded-0 text-white overflow zoom">
                                            <div class="position-relative">
                                                <!--thumbnail img-->
                                                <div class="ratio_right-cover-2 image-wrapper">
                                                    <a href="{{route('product.detail', $data->id)}}">
                                                        <img class="w-100 img-fluid" src="{{ asset('assets/images/product/'.$data->image->image)}}" alt="#" width="auto" height="auto">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <!-- category -->
                                                    <a style="font-size: 0.7rem" class="p-1 badge badge-primary rounded-0" href="{{ route('categories.index', ['subcategory_name' => $data->subcategory->subcategory_name] ) }}">
                                                        {{ $data->subcategory->subcategory_name }}
                                                    </a>

                                                    <!--title-->
                                                    <a href="{{route('product.detail', $data->id)}}">
                                                        <h2 class="h5 text-white my-1">
                                                            {{$data->product_name}}
                                                        </h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
                
                @if($heroInterior != NULL)
                    <h1 class="mt-5">Desain Interior</h1>
                    <section class="row">
                        <div class="col-12 col-md-6 pb-0 pb-md-3 pt-2 pr-md-1">
                            <div id="featured" class="carousel slide carousel" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="card border-0 rounded-0 text-light overflow zoom">
                                            <div class="position-relative">
                                                <div class="ratio_left-cover-1 image-wrapper">
                                                    <a href="{{route('product.detail', $heroInterior->id)}}">
                                                        <img class="img-fluid w-100"
                                                            src="{{asset('assets/images/product/'. $heroInterior->image->image )}}" alt="#">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <!-- category -->
                                                    <a class="p-1 badge badge-primary rounded-0"
                                                        href="{{route('categories.index', ['subcategory_name' => $heroInterior->subcategory->subcategory_name] )}}">
                                                        {{ $heroInterior->subcategory->subcategory_name }}
                                                    </a>

                                                    <!--title-->
                                                    <a href="{{ route('product.detail', $heroInterior->id) }}">
                                                        <h2 class="h5 text-white my-1">
                                                            {{ $heroInterior->product_name }}
                                                        </h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end item slider-->
                                </div>
                                <!--end carousel inner-->
                            </div>
                        </div>
                        <!--End slider news-->

                        <!--Start box news-->
                        <div class="col-12 col-md-6 pt-2 pl-md-1 mb-3 mb-lg-4">
                            <div class="row">
                                @foreach ($interior as $data)
                                    <div class="col-6 pb-1 pt-0 pr-1">
                                        <div class="card border-0 rounded-0 text-white overflow zoom">
                                            <div class="position-relative">
                                                <!--thumbnail img-->
                                                <div class="ratio_right-cover-2 image-wrapper">
                                                    <a href="{{route('product.detail', $data->id)}}">
                                                        <img class="w-100 img-fluid" src="{{ asset('assets/images/product/'.$data->image->image)}}" alt="#" width="auto" height="auto">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <!-- category -->
                                                    <a style="font-size: 0.7rem" class="p-1 badge badge-primary rounded-0" href="{{ route('categories.index', ['subcategory_name' => $data->subcategory->subcategory_name]) }}">
                                                        {{ $data->subcategory->subcategory_name }}
                                                    </a>

                                                    <!--title-->
                                                    <a href="{{ route('product.detail', $data->id) }}">
                                                        <h2 class="h5 text-white my-1">
                                                            {{$data->product_name}}
                                                        </h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
            @else
                <h2 class="text-center text-muted">Kosong</h2>
            @endif
        </div>
    </div>
</div>

<section style="background: #e8e8e8">
    <div class='container-fluid mx-auto py-3 col-12'>
        <h1 class="text-center">Apa Itu Homi Desain?</h1>
        <div class="row justify-content-center align-items-start">
            <div class="col-md-3 col-12">
                <h2>Lorem ipsum dolor sit amet.</h2>
                <h3>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus, ratione nisi repellat
                    voluptatibus nostrum voluptatum aliquam vel assumenda. Harum quisquam dolorum cupiditate numquam in
                    earum sapiente quam amet tempora provident?</h3>
            </div>
            <div class="col-md-3 col-12">
                <h2>Lorem ipsum dolor sit amet.</h2>
                <h3>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus, ratione nisi repellat
                    voluptatibus nostrum voluptatum aliquam vel assumenda. Harum quisquam dolorum cupiditate numquam in
                    earum sapiente quam amet tempora provident?</h3>
            </div>
            <div class="col-md-3 col-12">
                <h2>Lorem ipsum dolor sit amet.</h2>
                <h3>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus, ratione nisi repellat
                    voluptatibus nostrum voluptatum aliquam vel assumenda. Harum quisquam dolorum cupiditate numquam in
                    earum sapiente quam amet tempora provident?</h3>
            </div>
        </div>
    </div>
</section>


<section class="testimonial text-center">
    <div class="container">

        <div class="heading white-heading">
            Apa Kata Mereka?
        </div>
        <div id="testimonial4"
            class="carousel slide testimonial4_indicators testimonial4_control_button thumb_scroll_x swipe_x"
            data-ride="carousel" data-pause="hover" data-interval="5000" data-duration="2000">

            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="testimonial4_slide">
                        <img src="https://i.ibb.co/8x9xK4H/team.jpg" class="img-circle img-responsive" />
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book. </p>
                        <h4>Client 1</h4>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial4_slide">
                        <img src="https://i.ibb.co/8x9xK4H/team.jpg" class="img-circle img-responsive" />
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book. </p>
                        <h4>Client 2</h4>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial4_slide">
                        <img src="https://i.ibb.co/8x9xK4H/team.jpg" class="img-circle img-responsive" />
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book. </p>
                        <h4>Client 3</h4>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#testimonial4" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#testimonial4" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
</section>

{{-- <section class="bg-white py-2">
    <div class='container-fluid mx-auto py-3 col-12'>
        <h1 class="text-center">Apa kata mereka?</h1>
        <div class="row justify-content-center" style="width: 75%">

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <h1>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex sequi adipisci omnis dicta illo
                            mollitia, quisquam voluptatibus ea et, nulla quo minus voluptates illum pariatur delectus
                            alias
                            officia nostrum laborum.</h1>
                    </div>
                    <div class="carousel-item">
                        <h1>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex sequi adipisci omnis dicta illo
                            mollitia, quisquam voluptatibus ea et, nulla quo minus voluptates illum pariatur delectus
                            alias
                            officia nostrum laborum.</h1>
                    </div>
                    <div class="carousel-item">
                        <h1>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex sequi adipisci omnis dicta illo
                            mollitia, quisquam voluptatibus ea et, nulla quo minus voluptates illum pariatur delectus
                            alias
                            officia nostrum laborum.</h1>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="text-center">
            <a class="btn btn-link" href="#">Lihat Semua Testimoni</a>
        </div>
    </div>
</section> --}}

{{--
<!-- Gallery -->
<section id="galery" class="main-posts container">
    <h1 class="fashion_taital text-center my-2 mt-1">
        Galeri
    </h1>
    <div class="row">
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
            <a href="">
                <div class="galery-photo">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
                        class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" />
                    <div class="galery-layer">
                        <h3>Nature</h3>
                    </div>
                </div>
            </a>

            <a href="">
                <div class="galery-photo">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain1.webp"
                        class="w-100 shadow-1-strong rounded mb-4" alt="Wintry Mountain Landscape" />
                    <div class="galery-layer">
                        <h3>Mountain</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 mb-4 mb-lg-0">
            <a href="">
                <div class="galery-photo">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain2.webp"
                        class="w-100 shadow-1-strong rounded mb-4" alt="Mountains in the Clouds" />
                    <div class="galery-layer">
                        <h3>Mountain2</h3>
                    </div>
                </div>
            </a>

            <a href="">
                <div class="galery-photo">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
                        class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" />
                    <div class="galery-layer">
                        <h3>Nature54</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 mb-4 mb-lg-0">
            <a href="">
                <div class="galery-photo">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(18).webp"
                        class="w-100 shadow-1-strong rounded mb-4" alt="Waves at Sea" />
                    <div class="galery-layer">
                        <h3>Natur123e</h3>
                    </div>
                </div>
            </a>

            <a href="">
                <div class="galery-photo">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain3.webp"
                        class="w-100 shadow-1-strong rounded mb-4" alt="Yosemite National Park" />
                    <div class="galery-layer">
                        <h3>Nature231</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
<section id="category" class="fashion_section mt-5">
    <h1 class="fashion_taital text-center my-2">
        Kategori
    </h1>
    <div id="electronic_main_slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <br><br>
                    <div class="category-list">
                        <div class="row">
                            @foreach ($category as $item)
                            <div class="col-lg-6 col-sm-3 justify-content-center align-items-center">
                                <span style="font-size: 1.02rem; z-index:-900" class="d-inline">{{ $item->category_name
                                    }}</span>
                                <span style="font-size: 1.02rem; z-index:-900" class="d-inline">({{
                                    App\Models\Product::where('subcategory_id', $item->id)->count() }}
                                    items)</span>
                                <div class="category">
                                    <img src="{{ asset('assets') }}/images/category/{{$item->image}}" alt="">
                                    <form action="{{ route('categories.index') }}" method="GET">
                                        <input type="hidden" name="category_name"
                                            value="{{ strtolower($item->category_name) }}">
                                        <button type="submit" style="float: right;">
                                            <div class="layer">
                                                <h3>{{ $item->category_name }}</h3>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

@endsection

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
                        title: 'Error!',
                        message: response.error,
                        icon: 'fa fa-x fa-sm',
                        closeOnClick: true,
                        position: "topRight",
                    });
                    return false;
                }
                if (response) {
                    $('#likeDivButton'+productId).removeClass('scale-transition');

                    $('#likeDivButton'+productId).addClass('scale-transition');
                    if (response.isLiked == 1) {
                        $('#likeButton'+productId).removeClass('blue-logo').addClass('text-danger');
                        $('#likeIcon'+productId).removeClass('fa-regular').addClass('fa-solid');
                        iziToast.success({
                            title: 'Success!',
                            message: response.success,
                            icon: 'fa fa-check',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    } else {
                        $('#likeButton'+productId).removeClass('text-danger').addClass('blue-logo');
                        $('#likeIcon'+productId).removeClass('fa-solid').addClass('fa-regular');
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
                    $('#cartDivButton'+productId).removeClass('scale-transition');

                    $('#cartDivButton'+productId).addClass('scale-transition');
                    if (response.isCart == 1) {
                        $('#cartIcon'+productId).removeClass('blue-logo').addClass('text-success');
                        iziToast.success({
                            title: 'Success!',
                            message: response.success,
                            icon: 'fa fa-check',
                            closeOnClick: true,
                            position: "topRight",
                        });
                    } else {
                        $('#cartIcon'+productId).removeClass('text-success').addClass('blue-logo');
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