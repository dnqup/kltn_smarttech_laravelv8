<!doctype html>
<html lang="en">

<head>
    <title>SmartTech Admin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="./css/reset.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- style css and font -->
    <link rel="stylesheet" href="{{ asset( 'fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset( 'css/style-server.css') }}">

</head>

<body>
    <div class="app">

        <div class="content">

            <div class="navbar-left">
                <div class="navbar-left__brand">
                    <a href="{{ route('admin.home') }}">Admin SmartTech</a>
                </div>
                <div class="list-group">
                    <a href="#" class="list-group-item"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    <a href="{{ route('user.list') }}" class="list-group-item"><i class="fas fa-table"></i>Quản lý Users</a>
                    <a href="{{ route('categorie.list') }}" class="list-group-item"><i class="fas fa-table"></i>Quản lý danh mục</a>
                    <a href="{{ route('brand.list') }}" class="list-group-item"><i class="fas fa-table"></i>Quản lý nhãn hiệu</a>
                    <a href="{{ route('product.list') }}" class="list-group-item"><i class="fas fa-table"></i>Quản lý sản phẩm</a>
                    <a href="{{ route('order.list') }}" class="list-group-item"><i class="fas fa-table"></i>Quản lý đơn hàng</a>
                </div>
            </div>
            <div class="content-right">
                <header class="header">
                    <div class="container-fluid header-bar">
                        <div class="top-bar"><i class="fas fa-bars"></i></div>

                        <div class="btn-group">
                        @if(Auth::check())
                            <button type="button" class="btn dropdown-toggle acount-top" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <!-- <img src="{{ asset('images/products/item-img-1-1.jpg') }}" width="35px" alt=""> -->
                                {{ Auth::user()->name }}
                            </button>
                        @endif
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- <button class="dropdown-item style-item" type="button"><i class="fas fa-users-cog"></i>
                                    Cài đặt</button> -->
                                <button class="dropdown-item style-item" type="button"><i class="fas fa-key"></i> Đổi
                                    mật khẩu</button>
                                <!-- <a href="{{ route('logout') }}" class="dropdown-item style-item"><i
                                        class="fas fa-sign-out-alt"></i> Đăng xuât</a> -->

                                <a class="dropdown-item style-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Đăng xuât') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </div>
                        </div>
                    </div>

                </header>

                