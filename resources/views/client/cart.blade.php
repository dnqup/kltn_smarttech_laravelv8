@extends('client.layouts.master')
@section('content')
<section class="shopping">
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
                    <h4>Giỏ hàng của bạn</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col" class="text-center">Gía</th>
                                <th scope="col" class="text-center">Số lượng</th>
                                <th scope="col" class="text-center">Tổng giá</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $cart)
                            <form method="GET" action="{{ route('updateCart', $cart->rowId) }}">
                            <input type="hidden" name="rowId" value="{{ $cart->rowId}}" />
                            <input type="hidden" name="id" value="{{ $cart->id}}" />
                            <tr class="product-item">
                                <td scope="row" class="product-item__col_1">
                                    <div class="product-item__col_left">
                                        <a href="{{ route('get.productdetail', $cart->id) }}">
                                            <img src="{{asset('storage/product_images/'.$cart->options->image)}}"
                                                class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="product-item__col_right">
                                        <p>{{ $cart->name }}</p>
                                    </div>
                                    
                                    
                                </td>
                                <td class="product-item__col_2">
                                    <span class="align-middle">{{ number_format($cart->price)}} VNĐ</span>
                                </td>
                                <td class="product-item__col_3">
                                    <div class="input-group mb-3" >
                                        <input type="number" name="quantity" value="{{$cart->qty}}" class="form-control form-control-reset" min="1">
                                    </div>
                                </td>
                                <td class="product-item__col_2">
                                    <span>{{ number_format( ($cart->price) * ($cart->qty) )}} VNĐ</span>
                                </td>
                                <td class="product-item__col_5">
                                    <button type="submit" class="btn btn-info">Sửa</button>
                                    <a href="{{ route('deleteCart', $cart->rowId) }}"><button type="button" class="btn btn-warning">Xóa</button></a>
                                    
                                    
                                </td>
                            </tr>
                            </form>
                            @endforeach
                            
                            
                            
                            <tr>

                                <th scope="row" colspan="5" class="grand-total">
                                    <!-- <button id="update-all" type="button" class="btn btn-danger">Cập nhật all</button> -->
                                    <a href="{{ route('destroyCart') }}"><button type="button" class="btn btn-danger">Xóa all</button></a>
                                    <h5>Tổng cộng: {{ number_format($total)}} VNĐ</h5>
                                </th>
                                

                            </tr>

                        </tbody>
                    </table>
                    <div class="shopping-next">
                        
                        @if(Cart::count() > 0)
                        <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary">Tiếp tục mua sắm</button></a>
                        <a href="{{ route('checkOut') }}"><button type="button" class="btn btn-primary">Thanh toán</button></a>
                        @else
                        <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary">Tiếp tục mua sắm</button></a>
                        @endif
                        
                    </div>
                    
                </div>
            </div>
        </div>


    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $("#update-all").click(function() {
            var rowId = $("[name=rowId").val();
            var id = $("[name=id").val();
            var qty = $("[name=quantity]").val();
            // $.get( "updateCartAll" , {rowId: rowId, id: id, qty: qty}, function(data) {
            //     alert(123);
            // });
            $.ajax({
            type: "GET",
            url: "{{ route('updateCartAll')}}",
            data: {
                rowId: rowId, 
                id: id, 
                qty: qty
            },
            success:function(data){
                alert(data);
            }
        });
        });
    });
</script>
@endpush