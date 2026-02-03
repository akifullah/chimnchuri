<!DOCTYPE html>
<html lang="en">


<head>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>Dashboard - Chimnchurri</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Steak, Sides, Sauce. OPEN EVERY FRIDAY OR SATURDAY" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--
    <meta name="author" content="" /> --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    {{--
    <link rel="shortcut icon" href="assets/images/favicon.ico"> --}}

    <!-- Vendor css (Require in all Page) -->
    <link href="{{ asset('admin/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css (Require in all Page) -->
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme Config js (Require in all Page) -->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>

    @yield('style')



</head>

<body>

    <!-- START Wrapper -->
    <div class="wrapper">

        <!-- ========== Topbar Start ========== -->
        <header class="topbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="d-flex align-items-center">
                        <!-- Menu Toggle Button -->
                        <div class="topbar-item">
                            <button type="button" class="button-toggle-menu me-2">
                                <iconify-icon icon="solar:hamburger-menu-broken"
                                    class="fs-24 align-middle"></iconify-icon>
                            </button>
                        </div>

                        <!-- Menu Toggle Button -->
                        <div class="topbar-item">
                            <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0">Welcome!</h4>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-1">

                        <!-- Theme Color (Light/Dark) -->
                        {{-- <div class="topbar-item">
                            <button type="button" class="topbar-button" id="light-dark-mode">
                                <iconify-icon icon="solar:moon-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                            </button>
                        </div> --}}

                        <!-- Notification -->
                        <div class="dropdown topbar-item">
                            <button type="button" class="topbar-button position-relative"
                                id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <iconify-icon icon="solar:bell-bing-bold-duotone"
                                    class="fs-24 align-middle"></iconify-icon>
                                <span
                                    class="position-absolute topbar-badge fs-10 translate-middle badge bg-danger rounded-pill">3<span
                                        class="visually-hidden">unread messages</span></span>
                            </button>
                            <div class="dropdown-menu py-0 dropdown-lg dropdown-menu-end"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold"> Notifications</h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                                <small>Clear All</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 280px;">
                                    <!-- Item -->
                                    <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom text-wrap">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('admin/assets/images/users/avatar-1.jpg') }}"
                                                    class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-1" />
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0"><span class="fw-medium">Josephine Thompson
                                                    </span>commented on admin panel <span>" Wow 😍! this admin looks
                                                        good and awesome design"</span></p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Item -->
                                    <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm me-2">
                                                    <span
                                                        class="avatar-title bg-soft-info text-info fs-20 rounded-circle">
                                                        D
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0 fw-semibold">Donoghue Susan</p>
                                                <p class="mb-0 text-wrap">
                                                    Hi, How are you? What about our next meeting
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Item -->
                                    <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('admin/assets/images/users/avatar-3.jpg') }}"
                                                    class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-3" />
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0 fw-semibold">Jacob Gines</p>
                                                <p class="mb-0 text-wrap">Answered to your comment on the cash flow
                                                    forecast's graph 🔔.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Item -->
                                    <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm me-2">
                                                    <span
                                                        class="avatar-title bg-soft-warning text-warning fs-20 rounded-circle">
                                                        <iconify-icon
                                                            icon="iconamoon:comment-dots-duotone"></iconify-icon>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0 fw-semibold text-wrap">You have received <b>20</b> new
                                                    messages in the
                                                    conversation</p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Item -->
                                    <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="assets/images/users/avatar-5.jpg"
                                                    class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-5" />
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0 fw-semibold">Shawn Bunch</p>
                                                <p class="mb-0 text-wrap">
                                                    Commented on Admin
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="text-center py-3">
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm">View All Notification
                                        <i class="bx bx-right-arrow-alt ms-1"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Theme Setting -->
                        {{-- <div class="topbar-item d-none d-md-flex">
                            <button type="button" class="topbar-button" id="theme-settings-btn"
                                data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas"
                                aria-controls="theme-settings-offcanvas">
                                <iconify-icon icon="solar:settings-bold-duotone"
                                    class="fs-24 align-middle"></iconify-icon>
                            </button>
                        </div> --}}

                        <!-- Activity -->
                        {{-- <div class="topbar-item d-none d-md-flex">
                            <button type="button" class="topbar-button" id="theme-settings-btn"
                                data-bs-toggle="offcanvas" data-bs-target="#theme-activity-offcanvas"
                                aria-controls="theme-settings-offcanvas">
                                <iconify-icon icon="solar:clock-circle-bold-duotone"
                                    class="fs-24 align-middle"></iconify-icon>
                            </button>
                        </div> --}}

                        <!-- User -->
                        <div class="dropdown topbar-item">
                            <a type="button" class="topbar-button" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle" width="32"
                                        src="{{ asset('admin/assets/images/users/avatar-1.jpg') }}" alt="avatar-3">
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome Gaston!</h6>
                                <a class="dropdown-item" href="pages-profile.html">
                                    <i class="bx bx-user-circle text-muted fs-18 align-middle me-1"></i><span
                                        class="align-middle">Profile</span>
                                </a>
                                <a class="dropdown-item" href="apps-chat.html">
                                    <i class="bx bx-message-dots text-muted fs-18 align-middle me-1"></i><span
                                        class="align-middle">Messages</span>
                                </a>

                                <a class="dropdown-item" href="pages-pricing.html">
                                    <i class="bx bx-wallet text-muted fs-18 align-middle me-1"></i><span
                                        class="align-middle">Pricing</span>
                                </a>
                                <a class="dropdown-item" href="pages-faqs.html">
                                    <i class="bx bx-help-circle text-muted fs-18 align-middle me-1"></i><span
                                        class="align-middle">Help</span>
                                </a>
                                <a class="dropdown-item" href="auth-lock-screen.html">
                                    <i class="bx bx-lock text-muted fs-18 align-middle me-1"></i><span
                                        class="align-middle">Lock screen</span>
                                </a>

                                <div class="dropdown-divider my-1"></div>

                                <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}">
                                    <i class="bx bx-log-out fs-18 align-middle me-1"></i><span
                                        class="align-middle">Logout</span>
                                </a>
                            </div>
                        </div>

                        <!-- App Search-->
                        {{-- <form class="app-search d-none d-md-block ms-2">
                            <div class="position-relative">
                                <input type="search" class="form-control" placeholder="Search..." autocomplete="off"
                                    value="">
                                <iconify-icon icon="solar:magnifer-linear" class="search-widget-icon"></iconify-icon>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </div>
        </header>



        <!-- Right Sidebar (Theme Settings) -->
        {{-- <div>
            <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-settings-offcanvas">
                <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
                    <h5 class="text-white m-0">Theme Settings</h5>
                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>

                <div class="offcanvas-body p-0">
                    <div data-simplebar class="h-100">
                        <div class="p-3 settings-bar">

                            <div>
                                <h5 class="mb-3 font-16 fw-semibold">Color Scheme</h5>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-bs-theme"
                                        id="layout-color-light" value="light">
                                    <label class="form-check-label" for="layout-color-light">Light</label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-bs-theme"
                                        id="layout-color-dark" value="dark">
                                    <label class="form-check-label" for="layout-color-dark">Dark</label>
                                </div>
                            </div>

                            <div>
                                <h5 class="my-3 font-16 fw-semibold">Topbar Color</h5>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-topbar-color"
                                        id="topbar-color-light" value="light">
                                    <label class="form-check-label" for="topbar-color-light">Light</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-topbar-color"
                                        id="topbar-color-dark" value="dark">
                                    <label class="form-check-label" for="topbar-color-dark">Dark</label>
                                </div>
                            </div>


                            <div>
                                <h5 class="my-3 font-16 fw-semibold">Menu Color</h5>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-color"
                                        id="leftbar-color-light" value="light">
                                    <label class="form-check-label" for="leftbar-color-light">
                                        Light
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-color"
                                        id="leftbar-color-dark" value="dark">
                                    <label class="form-check-label" for="leftbar-color-dark">
                                        Dark
                                    </label>
                                </div>
                            </div>

                            <div>
                                <h5 class="my-3 font-16 fw-semibold">Sidebar Size</h5>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size"
                                        id="leftbar-size-default" value="default">
                                    <label class="form-check-label" for="leftbar-size-default">
                                        Default
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size"
                                        id="leftbar-size-small" value="condensed">
                                    <label class="form-check-label" for="leftbar-size-small">
                                        Condensed
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size"
                                        id="leftbar-hidden" value="hidden">
                                    <label class="form-check-label" for="leftbar-hidden">
                                        Hidden
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size"
                                        id="leftbar-size-small-hover-active" value="sm-hover-active">
                                    <label class="form-check-label" for="leftbar-size-small-hover-active">
                                        Small Hover Active
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size"
                                        id="leftbar-size-small-hover" value="sm-hover">
                                    <label class="form-check-label" for="leftbar-size-small-hover">
                                        Small Hover
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="offcanvas-footer border-top p-3 text-center">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" id="reset-layout">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- ========== Topbar End ========== -->

        <!-- ========== App Menu Start ========== -->
        <div class="main-nav">
            <!-- Sidebar Logo -->
            <div class="logo-box text-center">
                <a href="{{ route('admin.dashboard') }}" style="height: 100px; display: inline-block;">
                    <img src="{{ asset('admin/assets/images/logo.png') }}" height="100%" alt="Chimnchuri">
                </a>
            </div>

            <!-- Menu Toggle Button (sm-hover)-->
            <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
                <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone"
                    class="button-sm-hover-icon"></iconify-icon>
            </button>

            <div class="scrollbar" data-simplebar>
                <ul class="navbar-nav" id="navbar-nav">

                    <li class="menu-title">General</li>

                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <span class="nav-icon">
                                <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                            </span>
                            <span class="nav-text"> Dashboard </span>
                        </a>
                    </li>

                    {{-- PRODUCTS --}}
                    <li class="nav-item">
                        <a class="nav-link menu-arrow" href="#sidebarProducts" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarProducts">
                            <span class="nav-icon">
                                <iconify-icon icon="solar:t-shirt-bold-duotone"></iconify-icon>
                            </span>
                            <span class="nav-text"> Products </span>
                        </a>
                        <div class="collapse" id="sidebarProducts">
                            <ul class="nav sub-navbar-nav">
                                <li class="sub-nav-item">
                                    <a class="sub-nav-link" href="{{ route('products.index') }}">List</a>
                                </li>
                                <li class="sub-nav-item">
                                    <a class="sub-nav-link" href="{{ route('products.create') }}">Create</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- CATEGORY --}}
                    <li class="nav-item">
                        <a class="nav-link menu-arrow" href="#sidebarCategory" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarCategory">
                            <span class="nav-icon">
                                <iconify-icon icon="solar:clipboard-list-bold-duotone"></iconify-icon>
                            </span>
                            <span class="nav-text"> Category </span>
                        </a>
                        <div class="collapse" id="sidebarCategory">
                            <ul class="nav sub-navbar-nav">
                                <li class="sub-nav-item">
                                    <a class="sub-nav-link" href="{{ route('category.index') }}">List</a>
                                </li>

                                <li class="sub-nav-item">
                                    <a class="sub-nav-link" href="{{ route('category.create') }}">Create</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- ADDON CATEGORY --}}
                    <li class="nav-item">
                        <a class="nav-link menu-arrow" href="#sidebarAddonCategory" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarAddonCategory">
                            <span class="nav-icon">
                                <iconify-icon icon="solar:clipboard-list-bold-duotone"></iconify-icon>
                            </span>
                            <span class="nav-text"> Addon Category </span>
                        </a>
                        <div class="collapse" id="sidebarAddonCategory">
                            <ul class="nav sub-navbar-nav">
                                <li class="sub-nav-item">
                                    <a class="sub-nav-link"
                                        href="{{ route('admin.addon-categories.index') }}">List</a>
                                </li>

                                <li class="sub-nav-item">
                                    <a class="sub-nav-link"
                                        href="{{ route('admin.addon-categories.create') }}">Create</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- ADDON ITEMS --}}
                    <li class="nav-item">
                        <a class="nav-link menu-arrow" href="#sidebarAddonItems" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarAddonItems">
                            <span class="nav-icon">
                                <iconify-icon icon="solar:t-shirt-bold-duotone"></iconify-icon>
                            </span>
                            <span class="nav-text"> Addon Items </span>
                        </a>
                        <div class="collapse" id="sidebarAddonItems">
                            <ul class="nav sub-navbar-nav">
                                <li class="sub-nav-item">
                                    <a class="sub-nav-link" href="{{ route('admin.addon-items.index') }}">List</a>
                                </li>
                                <li class="sub-nav-item">
                                    <a class="sub-nav-link" href="{{ route('admin.addon-items.create') }}">Create</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- USERS --}}
                    <li class="nav-item">
                        <a class="nav-link menu-arrow" href="#sidebarUsers" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarUsers">
                            <span class="nav-icon">
                                <iconify-icon icon="solar:users-group-rounded-bold"></iconify-icon>
                            </span>
                            <span class="nav-text"> Users </span>
                        </a>
                        <div class="collapse" id="sidebarUsers">
                            <ul class="nav sub-navbar-nav">
                                <li class="sub-nav-item">
                                    <a class="sub-nav-link" href="{{ route('admin.users.index') }}">List</a>
                                </li>
                                <li class="sub-nav-item">
                                    <a class="sub-nav-link" href="{{ route('admin.users.create') }}">Create</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.smtp.index') }}">
                            <span class="nav-icon">
                                <iconify-icon icon="solar:letter-bold-duotone"></iconify-icon>
                            </span>
                            <span class="nav-text"> SMTP Settings </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('payment-gateways.index') }}">
                            <span class="nav-icon">
                                <iconify-icon icon="solar:card-bold-duotone"></iconify-icon>
                            </span>
                            <span class="nav-text"> Payment Gateways </span>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
        <!-- ========== App Menu End ========== -->

        <!-- ==================================================== -->
        <!-- Start right Content here -->
        <!-- ==================================================== -->
        <div class="page-content">

            <!-- Start Container Fluid -->
            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- End Container Fluid -->

            <!-- ========== Footer Start ========== -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            {{ date('Y') }} &copy; Chimnchurri. Developed by

                            <a href="https://webspires.com.pk?utm_source=chimnchurri" class="fw-bold "
                                target="_blank">Webspires</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- ========== Footer End ========== -->

        </div>
        <!-- ==================================================== -->
        <!-- End Page Content -->
        <!-- ==================================================== -->

    </div>
    <!-- END Wrapper -->

    <!-- Vendor Javascript (Require in all Page) -->
    <script src="{{ asset('admin/assets/js/vendor.js') }}"></script>

    <!-- App Javascript (Require in all Page) -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>

    <!-- Vector Map Js -->
    <script src="{{ asset('admin/assets/vendor/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/jsvectormap/maps/world.js') }}"></script>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('admin/assets/js/slugGenerator.js') }}"></script>

    @yield('javascript')


</body>


</html>
