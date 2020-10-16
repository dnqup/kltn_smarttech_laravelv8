@extends('admin.layouts.master')
@section('content')
<div class="content-right-main">
    <div class="container-fluid">
        <section class="table-headding">
            <h3>Danh sách người dùng</h3>
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
                <a href="{{ route('user.create') }}" class="btn btn-primary">Thêm mới</a>
            </div>
            <div class="card-body">
                <div class="table-filter">
                    <!-- <select id="inputState" class="form-control">
                        <option selected>Chọn trạng thái</option>
                        <option>Đang kích hoạt</option>
                        <option>Đang ẩn</option>
                    </select> -->
                    <div class="form-filter">
                    <input class="form-control" type="text" name="search" id="search" placeholder="Tìm kiếm theo email !!!" aria-label="Search" width="500px">
                        <!-- <button class="btn btn-secondary" type="submit">Tìm kiếm</button> -->
                    </div>
                    
                    
                </div>
                <table class="table table-striped table-style">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th width="10%">Họ và tên</th>
                            <th width="11%">Email</th>
                            <th width="9%">Avatar</th>
                            <th width="10%">Điện thoại</th>
                            <th width="10%">Địa chỉ</th>
                            <th width="10%">Phân quyền</th>
                            <th width="11%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($users as $key => $user)
                        <tr>
                            <th scope="row">{{ $key + 1}}</th>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email}}</td>
                            @if ($user->image) 
                            <td class="td-img"><img src="{{asset('storage/user_images/'.$user->image)}}"></td>
                            @else
                            <td ></td>
                            @endif
                            <td> (+84){{ $user->phone}}</td>
                            <td>{{ $user->address}}</td>
                            
                            <td>
                                <span class="{{ ($user->role === 1) ? 'user-admin' : 'user-kh'}}">{{ ($user->role === 1) ? 'Admin' : 'Khách hàng'}}</span>

                            </td>
                           
                            <td class="table-action">
                                <a  href="{{ route('user.edit', $user->id)}}" 
                                    class=" btn-info" 
                                >Edit</a>
                                <a  href="{{ route('user.destroy', $user->id)}}" 
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
        <div class="text-center mt-4">{{ $users->links() }}</div>
        
    </div>

</div>

@endsection

@push('scripts')
<script>
    $('#search').on('keyup',function(){
        
        $value = $(this).val();
        $.ajax({
            type: "GET",
            url: "{{ route('user.search')}}",
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