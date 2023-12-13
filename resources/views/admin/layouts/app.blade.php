@php
    $urlSegments = explode('/', request()->url());
    $lastSegment = last($urlSegments);
    if (count($urlSegments) >= 2) {
        $lastTwoSegments = $urlSegments[count($urlSegments) - 1] . '/' . $urlSegments[count($urlSegments) - 2];
    } else {
        $lastTwoSegments = null;
    }
    @endphp
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{$lastSegment}} - Homi Desain</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets') }}/admin/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/vendor/css/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/demo.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets') }}/admin/vendor/js/helpers.js"></script>
    <script src="{{ asset('assets') }}/admin/js/config.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <img src="{{ asset('assets') }}/admin/img/logo.png" width="80" />
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item {{ $lastSegment == "dashboard" ? 'active' : '' }}">
                        <a href="/admin/dashboard" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Dashboard</div>
                        </a>
                    </li>

                    <!-- Layouts -->
                    <li class="menu-item {{ $lastSegment == "category" || $lastSegment == "subcategory" || $lastSegment=="product" || $lastSegment=="rekening" || $lastTwoSegments == "create/category" || $lastTwoSegments == "create/subcategory" || $lastTwoSegments == "create/product" || $lastTwoSegments == "create/account" || $lastTwoSegments == "create/rekening" ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                            <div>Master Data</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item {{ $lastSegment == "category" || $lastTwoSegments == "create/category" ? 'active' : '' }}">
                                <a href="/admin/category" class="menu-link">
                                    <div>Category</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $lastSegment == "subcategory" || $lastTwoSegments == "create/subcategory" ? 'active' : '' }}">
                                <a href="/admin/subcategory" class="menu-link">
                                    <div>Sub Category</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $lastSegment == "product" || $lastTwoSegments == "create/product" ? 'active' : '' }}">
                                <a href="/admin/product" class="menu-link">
                                    <div>Product</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $lastSegment == "rekening" || $lastTwoSegments == "create/rekening" ? 'active' : '' }}">
                                <a href="/admin/rekening" class="menu-link">
                                    <div>Rekening</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="menu-item {{ $lastSegment == "account" || $lastSegment == "member-product" || $lastTwoSegments == "create/account" ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bxs-user"></i>
                            <div>Member</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item {{ $lastSegment == "account" || $lastTwoSegments == "create/account" ? 'active' : '' }}">
                                <a href="/admin/account" class="menu-link">
                                    <div>Account</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $lastSegment == "member-product" ? 'active' : '' }}">
                                <a href="/admin/member-product" class="menu-link">
                                    <div>Product Member @if ($approve > 0)
                                        <span class="badge bg-label-danger me-1">{{$approve}}</span>
                                    @endif</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item {{ $lastSegment == "incoming" ||
                        $lastSegment=="completed" ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-cart"></i>
                            <div>Transaction</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item {{ $lastSegment == "incoming" ? 'active' : '' }}">
                                <a href="/admin/incoming" class="menu-link">
                                    <div>Incoming @if ($incoming > 0)
                                        <span class="badge bg-label-danger me-1">{{$incoming}}</span>
                                    @endif</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $lastSegment == "completed" ? 'active' : '' }}">
                                <a href="/admin/completed" class="menu-link">
                                    <div>Completed</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item {{ $lastSegment == "blog" || $lastTwoSegments == "create/blog" ? 'active' : '' }}">
                        <a href="/admin/blog" class="menu-link">
                            <i class="menu-icon tf-icons bx bxl-blogger"></i>
                            <div>Blog</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('assets') }}/admin/img/avatars/1.png" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('assets') }}/admin/img/avatars/1.png" alt
                                                            class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ $loggedInUser->name }}</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                <span class="flex-grow-1 align-middle">Billing</span>
                                                <span
                                                    class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <form class="dropdown-item" action="{{ route('logout') }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-custom"><i class="bx bx-power-off me-2"></i>
                                                <span class="align-middle">Log Out</span></button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @yield('content')

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                Homi Desain. All Right Reserved.
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script>
        @if(Session::has('message'))
        toastr.options =
        {
          "closeButton" : true,
          "progressBar" : true
        }
              toastr.success("{{ session('message') }}");
        @endif
      
        @if(Session::has('error'))
        toastr.options =
        {
          "closeButton" : true,
          "progressBar" : true
        }
              toastr.error("{{ session('error') }}");
        @endif
      
        @if(Session::has('info'))
        toastr.options =
        {
          "closeButton" : true,
          "progressBar" : true
        }
              toastr.info("{{ session('info') }}");
        @endif
      
        @if(Session::has('warning'))
        toastr.options =
        {
          "closeButton" : true,
          "progressBar" : true
        }
              toastr.warning("{{ session('warning') }}");
        @endif
      </script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets') }}/admin/vendor/js/bootstrap.js"></script>

    <script src="{{ asset('assets') }}/admin/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{ asset('assets') }}/admin/js/main.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
        document.title = document.title.toLowerCase().replace(/\b\w/g, function(match) {
            return match.toUpperCase();
        });
    </script>
    
</body>

</html>