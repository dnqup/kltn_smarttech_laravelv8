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
                    <h4>Thông tin giao hàng</h4>
                    <div class="card-group">
                        <div class="card">
                            
                            <div class="card-body">
                                <h5 class="card-title">Thông tin nhận hàng</h5>
                                <p class="card-text">Người nhận: {{ $user->name }}</p>
                                <p class="card-text">Địa chỉ nhận hàng: {{ $user->address }}</p>
                                
                            </div>
                        </div>
                        <div class="card">
                            
                            <div class="card-body">
                                <h5 class="card-title">Phương thức vận chuyển</h5>
                                @if($total > 1000000)
                                <p class="card-text">Giao hàng miễn phí: 3-5 ngày</p>
                                @else
                                <p class="card-text">Chuyển phát nhanh: 3-5 ngày (+30,000 đ)</p>
                                @endif
                            </div>
                        </div>
                        <div class="card">
                            
                            <div class="card-body">
                                <h5 class="card-title">Thông tin đơn hàng</h5>
                                <p class="card-text">Tổng tiền: {{ number_format($total) }} VNĐ</p>
                                @if($total > 1000000)
                                <p class="card-text">Phí vận chuyển: 0 VNĐ</p>
                                @else
                                <p class="card-text">Phí vận chuyển: 30,000 VNĐ</p>
                                @endif

                                @if($total > 1000000)
                                <p class="card-text">Tổng cần thanh toán: {{ number_format($total) }} VNĐ</p>
                                @else
                                <p class="card-text">Tổng cần thanh toán: {{ number_format($total + 30000) }} VNĐ</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="shopping-next">
                        <a href="{{ route('get.cart') }}"><button type="button" class="btn btn-secondary">Quay lại</button></a>
                        <a href="{{ route('checkOutSuccess') }}"><button type="button" class="btn btn-primary">Xác nhận</button></a>
                        
                    </div>
                    
                </div>
            </div>
        </div>


    </div>
</section>
@endsection