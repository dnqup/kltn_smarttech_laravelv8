@extends('client.layouts.master')
@section('content')

<section class="list-product">
    <div class="container">
        <div class="row list-product__row">
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
            <div class="list-category-filter">
                
                <div class="hot_title bg-info">
                    <p>Tìm kiếm được {{ $productCount }} sản phẩm phù hợp với từ khóa "{{ $search }}"</p>
                </div>
                
                <div class="product-main">
                @foreach($products as $product)
                    <div class="product-item">
                        <a href="{{ route('get.productdetail', $product->id) }}">
                            <img src="{{asset('storage/product_images/'.$product->image)}}"
                                class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                alt="product">
                        </a>
                        <p class="product-cat">{{ $product->categorie_name }}</p>
                        <a href="{{ route('get.productdetail', $product->id) }}" class="tittle">{{ $product->product_name }}</a>
                        <div class="price">
                            <p class="listed-price">{{ number_format($product->price)}} VNĐ</p>
                            <p class="promotional-price">{{ number_format($product->promotion_price)}} VNĐ</p>
                        </div>
                        <a href="{{ route('addCart', $product->id) }}" class="icon-addcart"><i class="fas fa-cart-plus"></i></a>
                    </div>
                @endforeach
                </div>
            
            </div>
        </div>
        
    </div>
</section>
@endsection