@extends('client.layouts.master')
@section('content')
<section class="slid-sec">
        <div class="container">
            <div class="row">
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
                <div class="col-12 col-md-8 slid-sec-left">
                    <div id="carouselId" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselId" data-slide-to="1"></li>
                            <li data-target="#carouselId" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/800-300-800x300-5.png')}}" alt="Third slide" width="100%">

                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/800-300-800x300-6.png')}}" alt="First slide" width="100%">

                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/800-300-800x300-7.png')}}" alt="Second slide" width="100%">

                            </div>

                        </div>
                        <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 slid-sec-right">
                    <a href="#"><img src="{{ asset('images/Sam-samsung-398-110-398x110-1.png')}}" alt="Third slide"
                            width="100%"></a>
                    <a href="#"><img src="{{ asset('images/398-110-398x110-2.png')}}" alt="Third slide" width="100%"></a>

                    <a href="#"><img src="{{ asset('images/637352386702976608_637350728289544466_KMT9-H2-2x.png.jpeg')}}"
                            alt="Third slide" width="100%"></a>
                </div>
            </div>
        </div>
    </section>
    <section class="list-product">
        <div class="container">
            <div class="row list-product__row">
                <div class="category-filter">
                @foreach($brands as $brand)
                    <a href="/productfilter/{{$catName->id}}/{{$brand->id}}">
                        <img class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                            src="{{asset('storage/brand_images/'.$brand->image)}}" />
                    </a>
                    
                @endforeach
                </div>
                <div class="list-category-filter">
                    
                    <div class="product-sale_title">
                        <p>{{ $catName->categorie_name }}</p>
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