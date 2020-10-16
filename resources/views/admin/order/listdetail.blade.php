@extends('admin.layouts.master')
@section('content')
<div class="content-right-main">
    <div class="container-fluid">
        <section class="table-headding">
            <h3>Đơn hàng sô {{$idOrder}} trị giá {{number_format($orD->total)}} VNĐ</h3>
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
                <a href="{{ route('order.list') }}" class="btn btn-primary">Quay lại</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-style">
                    <thead>
                        <tr>
                            <th width="5%">id sản phẩm</th>
                            
                            <th width="15%">Tên sản phẩm</th>
                            <!-- <th width="11%">Danh mục</th>
                            <th width="10%">Nhãn hiệu</th> -->
                            <th width="15%">Hình ảnh</th>
                            <th width="10%">Số lượng</th>
                            <th width="10%">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($proDetail as $key => $od)
                            @if($od->id_order == $idOrder)
                            <tr>
                                <td>{{ $od->id }}</td>
                                <td>{{ $od->product_name }}</td>
                                <td class="td-img"><img src="{{asset('storage/product_images/'.$od->image)}}"></td>
                                <td>{{ ($od->quantity) }}</td>
                                <td>{{ number_format($od->unit_price) }} đ</td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center mt-4">{{ $proDetail->links() }}</div>
        
    </div>

</div>

@endsection

