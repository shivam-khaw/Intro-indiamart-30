<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <link href="{{asset('admin_assets/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/css/theme.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/css/custom.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <style>
        .logo,
        img {
            height: 50px !important;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu>li {
            position: relative;
        }

        .menu>li>a {
            display: block;
            padding: 10px;
            text-decoration: none;
        }

        .submenu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #fff;
            border: 1px solid #ccc;
            z-index: 1;
            /* Ensure submenu appears above other content */
        }

        .menu>li:hover .submenu {
            display: block;
        }

        .submenu>li>a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .submenu>li>a:hover {
            background-color: #f0f0f0;
        }
    </style>

</head>

<body>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="{{asset('admin_assets/admin_css_js/img/hub-logo.png')}}" height="50px" class="icn menuicn" id="menuicn" alt="menu-icon">
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled menu">
                        <li>
                            <a href="dashboard">
                                <i class="fa-solid fa-laptop-file"></i>Channels</a>
                        </li>

                        <li>
                            <a href="{{url('intigration')}}">
                                <i class="fa-solid fa-plug-circle-plus"></i>Integration with CRM
                            </a>
                        </li>
                        <li>
                            <a href="sub">
                                <i class="fa-solid fa-hand-holding-dollar"></i>Subscriptions</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="{{url('show_data')}}">
                                <i class="fa-solid fa-database"></i>Data
                                <i class="fa-solid fa-chevron-down"></i> <!-- Dropdown icon -->
                            </a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="#">Razorpay Data</a>
                                </li>
                                <li>
                                    <a href="{{url('show_data')}}">Indiamart Data</a>
                                </li>

                            </ul>
                        </li>
                       
                        <li>
                            <a href="{{route('profile.edit')}}">
                                <i class="fa-solid fa-users-gear"></i>Account Setting</a>
                        </li>
                        <li>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="zmdi zmdi-power"></i> {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>

                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('admin_assets/admin_css_js/img/hub-logo.png')}}" height="50px" class="icn menuicn" id="menuicn" alt="menu-icon">
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list menu">
                        <li>
                            <a href="dashboard">
                                <i class="fa-solid fa-laptop-file"></i>Channels</a>
                        </li>

                        <li>

                            <a href="{{url('intigration')}}">
                                <i class="fa-solid fa-plug-circle-plus"></i>Integration with CRM
                            </a>
                        </li>
                        <li>
                            <a href="{{url('indiamart_price')}}">
                                <i class="fa-solid fa-hand-holding-dollar"></i>Subscriptions</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="{{url('show_data')}}   ">
                                <i class="fa-solid fa-database"></i>Data
                                <i class="fa-solid fa-chevron-down"></i> <!-- Dropdown icon -->
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="#">Razorpay Data</a>
                                </li>
                                <li>
                                    <a href="{{url('show_data')}}">Indiamart Data</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="{{route('profile.edit')}}">
                                <i class="fa-solid fa-users-gear"></i>Account Setting</a>
                        </li>
                        <li>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="zmdi zmdi-power"></i> {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>

                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">

                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">

                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">

                                                    <x-dropdown-link :href="route('profile.edit')">
                                                        <i class="zmdi zmdi-account"></i> {{ __('Profile') }}
                                                    </x-dropdown-link>
                                                </div>

                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf

                                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                        <i class="zmdi zmdi-power"></i> {{ __('Log Out') }}
                                                    </x-dropdown-link>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @section('container')
                        @show

                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTAINER-->

    </div>


    <script src="{{asset('admin_assets/vendor/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
    <script src="{{asset('admin_assets/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/main.js')}}"></script>
</body>

</html>