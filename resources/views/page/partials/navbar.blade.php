@php
$categories = App\Models\Category::get();
@endphp
<div class="fixed-top">
    <nav class="navbar navbar-expand navbar-light bg-light d-none d-md-block">
        <div class="container-fluid col-md-12">
            <div class="navbar-header pull-left ">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets') }}/images/homidesain-closing.png" width="90">
                </a>
            </div>

            <div class="navbar-center justify-content-center col-md-5 mt-3">
                <form class="d-flex align-items-start" role="search" method="GET" action="/search">
                    <div class="form-group mx-1">
                        <select name="category" class="form-control">
                            @foreach ($categories as $category)
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" value="{{ request('keyword') }}"
                            placeholder="Search this product">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit"
                                style="background-color: #776B5D; border-color:#776B5D ">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            @php
            if(auth()->user()) {
            $likedProduct = App\Models\LikedProduct::where('user_id', auth()->user()->id)->count();
            $cart = App\Models\Cart::where('user_id', auth()->user()->id)->count();
            } else {
            $likedProduct = $cart = 0;
            }
            @endphp

            <div class="navbar-right pull-right ">
                <ul class="nav navbar-nav">
                    <li class="mx-2">
                        <a href="{{ route('liked-product.index') }}">
                            <i class="fa-xl fa-regular fa-heart"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">{{ $likedProduct }}</span>
                        </a>
                    </li>
                    <li class="mx-2">
                        <a href="{{ route('cart.index') }}">
                            <i class="fa-xl fa fa-shopping-cart" aria-hidden="true"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">{{ $cart }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid d-flex d-md-none">
            <div class="navbar-header pull-left">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets') }}/images/homidesain-closing.png" width="80">
                </a>
            </div>

            <div class="navbar-center">

            </div>

            <div class="navbar-right pull-right">
                <ul class="nav navbar-nav">
                    <li class="mx-1">
                        <a class="mx-1 open-search" href="#" style="color: white;" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-search fa-xl"></i>
                        </a>
                        <div class="dropdown-menu custom-dropdown" aria-labelledby="searchDropdown">
                            <div class="dropdown-item">
                                <form role="search" method="GET" action="/search">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control" name="category" id="selectOption"
                                            onclick="stopDropdownClose(event)">
                                            @foreach ($categories as $category)
                                            <option value="{{$category->category_name}}">
                                                {{$category->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Search</label>
                                        <input type="text" class="form-control" name="keyword"
                                            value="{{ request('keyword') }}" placeholder="Search this product">
                                    </div>
                                    <button type="submit" class="btn btn-success">Search</button>
                                </form>
                            </div>
                        </div>
                        @if (Auth::user())
                        <a class="mx-1" id="dropdownUser" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;">
                            <i class="fa-regular fa-user-circle-o fa-xl"></i>
                        </a>
                        <div class="dropdown-menu custom-dropdown" aria-labelledby="dropdownUser">
                            <a class="dropdown-item" href="{{url('/profile')}}">Profile</a>
                            <a class="dropdown-item" href="{{url('/cart')}}">Keranjang Saya</a>
                            <a class="dropdown-item" href="{{url('/logout')}}">Logout</a>
                        </div>
                        @else
                        <a class="mx-1" href="{{ route('login') }}" style="color: white;">
                            <i class="fa fa-sign-in fa-xl"></i>
                        </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <div class="w-100 d-flex justify-content-center d-md-none">
            <li class="nav-item mx-1 active">
                <a class="nav-link" href="{{url('/home')}}">Home</a>
            </li>
            <li class="nav-item mx-1">
                <a class="nav-link" href="{{url('/catalog-product')}}">Katalog</a>
            </li>
            <li class="nav-item mx-1">
                <a class="nav-link" href="#">Contact Us</a>
            </li>
            <li class="nav-item mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownAndroid" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Kategori
                </a>
                <div class="dropdown-menu custom-dropdown" aria-labelledby="dropdownAndroid">
                    <h3 class="dropdown-item">{{$category->category_name}}</h3>
                    <div class="dropdown-divider"></div>
                    @foreach ($subcategory as $sc)
                    <a class="dropdown-item"
                        href="{{route('categories.index', ['subcategory_name' => strtolower($sc->subcategory_name)])}}">{{$sc->subcategory_name}}</a>
                    @endforeach
                </div>
            </li>
        </div>
        <div class="container d-none d-md-flex">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a style="font-size: 1.1rem" class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Kategori Produk
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categories as $category)
                            <h3 class="dropdown-item"><b>{{ $category->category_name }}</b></h3>
                            <div class="dropdown-divider"></div>
                            @php
                                $subcategories = App\Models\SubCategory::where('category_id', $category->id)->get();
                            @endphp
                            @foreach ($subcategories as $subcategory)
                                <a class="dropdown-item" href="{{ route('categories.index', ['subcategory_name' => strtolower($subcategory->subcategory_name) ]) }}">{{ $subcategory->subcategory_name }}</a>
                            @endforeach
                            <div class="dropdown-divider"></div>
                        @endforeach
                    </div>
                </li>
            </ul>
            <div class="collapse navbar-collapse" id="navbarNavTop">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ $is_active == 'home' ? 'active' : '' }}">
                        <a style="font-size: 1rem" class="nav-link" href="{{ route('home.index') }}">Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ $is_active == 'catalog' ? 'active' : '' }}">
                        <a style="font-size: 1rem" class="nav-link"
                            href="{{ route('catalog-product.index') }}">Katalog</a>
                    </li>
                    <li class="nav-item {{ $is_active == 'blog' ? 'active' : '' }}">
                        <a style="font-size: 1rem" class="nav-link" href="/blog">Blog</a>
                    </li>
                    <li class="nav-item {{ $is_active == 'testimoni' ? 'active' : '' }}">
                        <a style="font-size: 1rem" class="nav-link" href="/testimoni">Testimoni</a>
                    </li>
                    <li
                        class="nav-item dropdown {{ $is_active == 'login' || $is_active == 'register' ? 'active' : '' }}">
                        @if (Auth::user())
                        <a style="font-size: 1.1rem" class="nav-link dropdown-toggle" href="#" id="dropdownUserPC"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownUserPC">
                            <a class="dropdown-item" href="{{url('/member/profile')}}">Profile</a>
                            <a class="dropdown-item" href="{{url('/cart')}}">Keranjang Saya</a>
                            <a class="dropdown-item" href="{{url('/logout')}}">Logout</a>
                        </div>
                        @else
                        <a style="font-size: 1rem" class="nav-link" href="{{ route('login') }}">Login/Register</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
    function stopDropdownClose(event) {
      event.stopPropagation();
    }
</script>