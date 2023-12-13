@extends('page.partials.main')

@section('title')
Profile
@endsection

@push('css')
<style>
    @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";


    body {
        font-family: 'Poppins', sans-serif;
        background: #fafafa;
    }

    p {
        font-family: 'Poppins', sans-serif;
        font-size: 1.1em;
        font-weight: 300;
        line-height: 1.7em;
        color: #fff;
    }

    a,
    a:hover,
    a:focus {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s;
    }

    .navbar-btn {
        box-shadow: none;
        outline: none !important;
        border: none;
    }

    .line {
        width: 100%;
        height: 1px;
        border-bottom: 1px dashed #fff;
        margin: 40px 0;
    }

    /* ---------------------------------------------------
SIDEBAR STYLE
----------------------------------------------------- */

    .wrapper {
        display: flex;
        width: 100%;
        align-items: stretch;
        perspective: 1500px;
    }


    #sidebar {
        min-width: 250px;
        max-width: 250px;
        background: #383c44;
        transition: all 0.6s cubic-bezier(0.945, 0.020, 0.270, 0.665);
        transform-origin: bottom left;
    }

    #sidebar.active {
        margin-left: -250px;
        transform: rotateY(100deg);
    }

    #sidebar .sidebar-header {
        /*padding: 20px;*/
        height: 70px;
        text-align: center;
        padding: 18px;
        background: #f8f9fa;
    }

    #sidebar ul.components {
        padding: 20px 0;
        border-bottom: 1px solid #fff;
    }

    #sidebar ul p a {
        color: #fff;
        padding: 10px;
    }

    #sidebar ul li a {
        padding: 10px;
        font-size: 1.1em;
        display: block;
    }

    #sidebar ul li a:hover {
        color: #000;
        background: #e8e8e8;
    }

    #sidebar ul li.active>a,
    a[aria-expanded="true"] {
        color: #000;
        background: #e8e8e8;
    }


    a[data-toggle="collapse"] {
        position: relative;
    }

    .custom-dropdown::after {
        display: block;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }

    ul ul a {
        font-size: 0.9em !important;
        padding-left: 30px !important;
        /*background: #6d7fcc;*/
    }

    ul.CTAs {
        padding: 20px;
    }

    ul.CTAs a {
        text-align: center;
        font-size: 0.9em !important;
        display: block;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    a.download {
        background: #fff;
        /*color: #7386D5;*/
    }

    a.article,
    a.article:hover {
        background: #6d7fcc !important;
        color: #fff !important;
    }



    /* ---------------------------------------------------
CONTENT STYLE
----------------------------------------------------- */
    #content {
        width: 100%;
        /*padding: 20px;*/
        min-height: 100vh;
        transition: all 0.3s;
    }

    .navbar-light {
        background: #6d7fcc;
    }

    .container-content {
        width: 100%;
        padding: 10px;
        min-height: 100vh;
    }

    #sidebarCollapse {
        width: 40px;
        height: 40px;
        background: #f5f5f5;
        cursor: pointer;
    }

    #sidebarCollapse span {
        width: 80%;
        height: 2px;
        margin: 0 auto;
        display: block;
        background: #555;
        transition: all 0.8s cubic-bezier(0.810, -0.330, 0.345, 1.375);
        transition-delay: 0.2s;
    }

    #sidebarCollapse span:first-of-type {
        transform: rotate(45deg) translate(2px, 2px);
    }

    #sidebarCollapse span:nth-of-type(2) {
        opacity: 0;
    }

    #sidebarCollapse span:last-of-type {
        transform: rotate(-45deg) translate(1px, -1px);
    }


    #sidebarCollapse.active span {
        transform: none;
        opacity: 1;
        margin: 5px auto;
    }


    /* ---------------------------------------------------
MEDIAQUERIES
----------------------------------------------------- */
    @media (max-width: 768px) {
        #sidebar {
            margin-left: -250px;
            transform: rotateY(90deg);
        }

        #sidebar.active {
            margin-left: 0;
            transform: none;
        }

        #sidebarCollapse span:first-of-type,
        #sidebarCollapse span:nth-of-type(2),
        #sidebarCollapse span:last-of-type {
            transform: none;
            opacity: 1;
            margin: 5px auto;
        }

        #sidebarCollapse.active span {
            margin: 0 auto;
        }

        #sidebarCollapse.active span:first-of-type {
            transform: rotate(45deg) translate(2px, 2px);
        }

        #sidebarCollapse.active span:nth-of-type(2) {
            opacity: 0;
        }

        #sidebarCollapse.active span:last-of-type {
            transform: rotate(-45deg) translate(1px, -1px);
        }

    }
</style>
@endpush

@section('contents')
<div class="wrapper">
    <nav id="sidebar">
        <ul class="list-unstyled components text-white">
            <li class="{{$member_active=='profile' ? 'active' : '' }}"">
                <a href=" {{url('/member/profile')}}">Profile Saya</a>
            </li>
            <li class="{{$member_active=='pesanan-saya' ? 'active' : '' }}">
                <a href="{{url('/member/pesanan-saya')}}">Pesanan Saya</a>
            </li>
            <li class="{{$member_active=='produk' || $member_active=='pesanan'
                ? 'active' : '' }}">
                <a href="#tokoSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Kresasi
                    Ku</a>
                <ul class="collapse list-unstyled {{$member_active == 'produk' || $member_active == 'pesanan' ? 'show' : ''}}"
                    id="tokoSubmenu">
                    <li class="{{$member_active=='produk' ? 'active' : '' }}">
                        <a href="{{url('/member/produk')}}">Desain</a>
                    </li>
                    <li class="{{$member_active=='pesanan' ? 'active' : '' }}">
                        <a href="{{url('/member/pesanan')}}">List Pesanan</a>
                    </li>
                </ul>
            </li>
            <li class="{{$member_active=='referral-code' ? 'active' : '' }}">
                <a href="{{url('/member/referral-code')}}">Kode Referral</a>
            </li>
        </ul>
    </nav>

    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <ul class="nav navbar-nav flex-row">

                </ul>
            </div>
        </nav>
        <div class="container-content">
            @yield('member_content')
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });
</script>
@endsection