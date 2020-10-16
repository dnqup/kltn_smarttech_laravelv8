@extends('admin.layouts.master')
@section('content')
<div class="content-right-main">
    <div class="container-fluid">
        <section class="table-headding">
            <h3>Danh sách nhãn hiệu</h3>
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
                <a href="{{ route('brand.create') }}" class="btn btn-primary">Thêm mới</a>
            </div>
            <div class="card-body">
                <div class="table-filter">
                    <!-- <select id="inputState" class="form-control">
                        <option selected>Chọn trạng thái</option>
                        <option>Đang kích hoạt</option>
                        <option>Đang ẩn</option>
                    </select> -->
                    <div class="form-filter">
                    <input class="form-control" type="text" name="search" id="search" placeholder="Tìm kiếm theo tên nhãn hiệu !!!" aria-label="Search" width="500px">                      
                      <!-- <button class="btn btn-secondary" type="submit">Tìm kiếm</button> -->
                    </div>
                    
                    
                </div>
                <table class="table table-striped table-style">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên nhãn hiệu</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($brands as $key => $brand)
                        <tr>
                            <th scope="row">{{ $key + 1}}</th>
                            <td>{{ $brand->brand_name}}</td>
                            <td><img width="30%" src="{{asset('storage/brand_images/'.$brand->image)}}"></td>
                            <td>
                                <span class="{{ ($brand->status === 1)?'status__active':'status__no-active'}}">
                                    {{ ($brand->status === 1)?'Đang hiển thị':'Đang ẩn' }}
                                </span>
                            </td>
                            <td>{{ $brand->created_at}}</td>
                            <td class="table-action">
                                <a  href="{{ route('brand.edit', $brand->id)}}" 
                                    class=" btn-info" 
                                >Edit</a>
                                <a  href="{{ route('brand.destroy', $brand->id)}}" 
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
        <div class="text-center mt-5">{{ $brands->links() }}</div>
        
    </div>

</div>

@endsection

@push('scripts')
<script>
    $('#search').on('keyup',function(){
        
        $value = $(this).val();
        $.ajax({
            type: "GET",
            url: "{{ route('brand.search')}}",
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