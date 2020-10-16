<!doctype html>
<html lang="en">

<head>
    <title>SmartTech</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="./css/reset.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- style css and font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/style-client.css')}}">

</head>

<body>
    <div class="top-bar">
        <div class="container">
            <div class="row top-bar__style">
                <p class="welcome">Chào mừng bạn đến với trung tâm SmartTech!</p>
                <div class="right-sec">
                    <ul>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Đăng xuât') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                        <!-- <li>
                            <a href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                        <li>/</li>
                        <li>
                            <a href="{{ route('register') }}" class="reset-padding">Đăng ký</a>
                        </li>
                         -->
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-6 col-sm-4">
                    <a href="{{ route('home') }}" class="logo"><img src="{{asset('images/logo.png')}}" alt="Logo SmartTech"></a>
                </div>
                <div class="col-sm-6 search">
                <form method="GET" action="{{ route('get.search') }}" enctype="multipart/form-data">
                @csrf
                        <input class="input-search" name="search" type="search" placeholder="Bạn tìm gì?">
                        <button class="search-icon" type="submit"><i class="fas fa-search"></i></button>
                </form>
                </div>
                <div class="col-6 col-sm-2 cart">
                    <a href="{{ route('get.cart') }}">
                        <!-- <span class="itm-cont"></span> -->
                        <span class="cart-icon"><i class="fas fa-shopping-cart"></i></span>
                        <span class="cart-text">Giỏ hàng</span>
                    </a>
                </div>

            </div>
        </div>
        <nav class="nav">
            <div class="container no-mr-pd">
                <div class="row">
                    <div class="col-sm-12">

                        <nav class="navbar navbar-expand-md navbar-light">

                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav">
                                    @foreach($listCats as $listCat)
                                    <a class="nav-link" href="{{ route('get.product', $listCat->id ) }}">
                                        
                                        {{$listCat->categorie_name}}
                                    </a>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </nav>
    </header>