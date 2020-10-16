@extends('admin.layouts.master')
@section('content')
<div class="content-right-main">
    <div class="container-fluid">
        <section class="table-headding">
            <h3>Danh sách đơn hàng</h3>
            @if (session('success'))
            <div aria-live="polite" aria-atomic="true">
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
        </section>
        <div class="card">
            <div class="card-header card-add">
                
            </div>
            <div class="card-body">
                <div class="table-filter">
                    
                    <!-- <div class="form-filter">
                    <input class="form-control" type="text" name="search" id="search" placeholder="Tìm kiếm theo tên sản phẩm !!!" aria-label="Search" width="500px">
                       
                    </div> -->
                    
                    
                </div>
                <table class="table table-striped table-style">
                    <thead>
                        <tr>
                            <th width="8%">Mã đơn hàng</th>
                            <th width="10%">Khách hàng</th>
                            <th width="4%">COD/ATM</th>
                            <th width="15%">Địa chỉ nhận hàng</th>
                            <th width="10%">Tổng tiền</th>
                            <th width="8%">Ngày đặt</th>
                            <th width="10%">Trạng thái</th>
                            
                            <th width="16%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($orders as $key => $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>{{ $order->name}}</td>
                            <td>{{ ($order->payment == 1)?'COD':'ATM' }}</td>
                            
                            <td>(+84) {{ $order->phone }}, {{ $order->address }}</td>
                            <td>{{ number_format($order->total)}} VNĐ</td>
                            <td>{{ $order->date_order }}</td>
                            <td>
                                <span class="{{ ($order->status === 1)?'status__active':'status__no-active'}}">
                                    {{ ($order->status === 1)?'Đã xác nhận':'Chưa xác nhận' }}
                                </span>
                            </td>
                            
                            <td>
                                @if($order->status == 0)
                                    <a href="{{ route('order.check', $order->id) }}" class="btn btn-success"> Xác nhận</a>
                                    <a href="{{ route('order.show', $order->id) }}" class="btn btn-info"> Xem</a>
                                    <a href="{{ route('order.destroy', $order->id) }}" class="btn btn-danger"> Hủy</a>
                                @else
                                    <a href="{{ route('order.show', $order->id) }}" class="btn btn-info"> Xem</a>
                                    <a href="{{ route('order.destroy', $order->id) }}" class="btn btn-danger"> Hủy</a>
                                @endif
                                
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center mt-4">{{ $orders->links() }}</div>
        
    </div>

</div>

@endsection

