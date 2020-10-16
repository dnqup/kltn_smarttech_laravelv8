@extends('admin.layouts.master')
@section('content')
<div class="content-right-main">
    <div class="container-fluid">
        <section class="table-headding">
            <h3>Danh sách sản phẩm</h3>
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
                <a href="{{ route('product.create') }}" class="btn btn-primary">Thêm mới</a>
            </div>
            <div class="card-body">
                <div class="table-filter">
                    <!-- <select id="inputState" class="form-control">
                        <option selected>Chọn trạng thái</option>
                        <option>Đang kích hoạt</option>
                        <option>Đang ẩn</option>
                    </select> -->
                    <div class="form-filter">
                    <input class="form-control" type="text" name="search" id="search" placeholder="Tìm kiếm theo tên sản phẩm !!!" aria-label="Search" width="500px">
                        <!-- <button class="btn btn-secondary" type="submit">Tìm kiếm</button> -->
                    </div>
                    
                    
                </div>
                <table class="table table-striped table-style">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th width="15%">Tên sản phẩm</th>
                            <th width="9%">Hình ảnh</th>
                            <!-- <th width="11%">Danh mục</th>
                            <th width="10%">Nhãn hiệu</th> -->
                            <th width="10%">Giá niêm yết</th>
                            <th width="10%">Giá khuyến mãi</th>
                            <th width="10%">Trạng thái</th>
                            <th width="10%">Ngày tạo</th>
                            <th width="11%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($products as $key => $product)
                        <tr>
                            <th scope="row">{{ $key + 1}}</th>
                            <td>{{ $product->product_name}}</td>
                            <td class="td-img"><img src="{{asset('storage/product_images/'.$product->image)}}"></td>
                            <!-- @foreach ($categories as  $categorie)
                                @if($product->id_categorie === $categorie->id)
                                    <td>{{ $categorie->categorie_name}}</td>
                                @endif
                            @endforeach
                            @foreach ($brands as  $brand)
                                @if($product->id_brand === $brand->id)
                                    <td>{{ $brand->brand_name}}</td>
                                @endif
                            @endforeach -->
                            <td>{{ number_format($product->price)}} VNĐ</td>
                            <td>{{ number_format($product->promotion_price)}} VNĐ</td>
                            
                            <td>
                                <span class="{{ ($product->status === 1)?'status__active':'status__no-active'}}">
                                    {{ ($product->status === 1)?'Đang hiển thị':'Đang ẩn' }}
                                </span>
                            </td>
                            <td>{{ $product->created_at}}</td>
                            <td class="table-action">
                                <a  href="{{ route('product.edit', $product->id)}}" 
                                    class=" btn-info" 
                                >Edit</a>
                                <a  href="{{ route('product.destroy', $product->id)}}" 
                                    class=" btn-danger" 
                                    onclick="return checkDelete()"
                                >Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center mt-4">{{ $products->links() }}</div>
        
    </div>

</div>

@endsection

@push('scripts')
<script>
    $('#search').on('keyup',function(){
        
        $value = $(this).val();
        $.ajax({
            type: "GET",
            url: "{{ route('product.search')}}",
            data: {
                "search": $value
            },
            success:function(data){
                $("tbody").html(data);
            }
        });
    });
    // $.ajaxSetup({ headers: { "csrftoken" : "{{ csrf_token() }}" } }); 
</script>
@endpush