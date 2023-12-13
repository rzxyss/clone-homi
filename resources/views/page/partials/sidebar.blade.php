<div class="logo_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="logo"><a href="index.html"></a></div>
            </div>
        </div>
    </div>
</div>
<!-- logo section end -->
<!-- header section start -->
<div class="header_section">
    <div class="container">
        <div class="containt_main">
            <div id="mySidenav" class="sidenav">
                <div class="logo"><a href="index.html"><img
                            src="{{ asset('assets') }}/images/homidesain-closing.png"></a></div>
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="index.html">Modern</a>
                <a href="fashion.html">Vintage</a>
                <a href="electronic.html">Skandinavian</a>
                <a href="jewellery.html">Tropis</a>
                <a href="jewellery.html">Klasik</a>
            </div>
            <span class="toggle_icon" onclick="openNav()"><img
                    src="{{ asset('assets') }}/images/toggle-icon.png">
                <p class="navbar-brand" href="#">Kategori Produk</p>
            </span>
            <div class="main">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search this blog">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button"
                            style="background-color: #776B5D; border-color:#776B5D ">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="header_box">
                <div class="login_menu">
                    <ul>
                        <li>
                            <a href="{{ route('liked-product.index') }}">
                                <i class="fa-regular fa-heart"></i>
                                <span class="padding_10">Disukai</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cart.index') }}">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span class="padding_10">Keranjang</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>