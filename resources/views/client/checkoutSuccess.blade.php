@extends('client.layouts.master')
@section('content')
<section class="check-out">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.cart') }}">giỏ hàng</a></li>

                    </ol>
                </nav>
                </ul>
            </div>
            <div class="col-12 col-md-12 shopping-cart">
                <div>
                    
                    <div class="cart-success">
                        <div class="cart-success__icon"><i class="far fa-check-circle"></i></div>
                        <h4>Chúc mừng! Đơn hàng của bạn đã được xử lý</h4>
                        <p>Hãy chờ SmartTech xác nhận và vẩn chuyển đến tay bạn nhé!</p>
                    </div>  
                    <div class="shopping-next">
                        <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary">Quay lại cửa hàng</button></a>
                        
                        
                    </div>
                    
                </div>
            </div>
        </div>


    </div>
</section>
@endsection