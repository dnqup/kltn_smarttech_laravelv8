@extends('client.layouts.master')
@section('content')
<section class="product-details">
        <div class="container">
            <div class="row product-details_row">
            @if (session('success'))
                <div id="thongbao" aria-live="polite" aria-atomic="true">
                    <div class="toast toast-success" data-delay="3000">
                        <div class="toast-header bg-success text-white">
                            <strong class="mr-auto">{{ session('success') }}</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('get.product', $product->id_categorie) }}">{{ $product->categorie_name }}</a></li>
                            <li class="breadcrumb-item"><a href="/productfilter/{{$product->id_categorie}}/{{$product->id_brand}}">{{ $product->brand_name }}</a></li>
                        </ol>
                    </nav>
                    </ul>
                </div>
                <div class="col-md-12 product-details__name">
                    <h4>{{ $product->product_name }}</h4>
                </div>
                <div class="col-md-5 product-details__image">
                    <div>
                        <img src="{{asset('storage/product_images/'.$product->image)}}" alt=""
                            class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}">
                    </div>
                </div>
                <div class="col-md-7 product-details__main">
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <span class="title">Thông tin sản phẩm</span>
                        </li>

                        <li class="list-group-item">

                            Danh mục: {{ $product->categorie_name }}
                        </li>
                        <li class="list-group-item">

                            Thương hiệu: {{ $product->brand_name }}
                        </li>
                        
                        <li class="list-group-item product-details__main__price">
                            {{ number_format($product->promotion_price)}} VNĐ
                            <span>{{ number_format($product->price)}} VNĐ</span>
                        </li>
                    </ul>
                    <div class="add-cart">

                        <a href="{{ route('addCart', $product->id) }}"><i class="fas fa-cart-plus"></i><span>Mua ngay</span> </a>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="des-title">
                        <h4>Đặc điểm nổi bật của {{ $product->product_name }}</h4>
                        <p>
                            {{ $product->description }}

                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection