@extends('client.layouts.master')
@section('content')

<section class="list-product">
    <div class="container">
        <div class="row list-product__row">
            
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
                        <a href="#" class="icon-addcart"><i class="fas fa-cart-plus"></i></a>
                    </div>
                @endforeach
                </div>
            
            </div>
        </div>
        
    </div>
</section>
@endsection