@extends('admin.layouts.master')
@section('content')
<div class="content-right-main">
    <div class="container">
        <section class="table-headding">
            <h3>Cập nhật người dùng</h3>
        </section>
        <form method="POST" action="{{ route('user.update', $editUser->id) }}" enctype="multipart/form-data">
        @csrf
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="name">Họ tên</label>
                    <input type="text" name="name" value="{{ old('name') ? old('name') : $editUser->name}}" class="form-control" id="name">
                    @error('name')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone">Điện thoại</label>
                    <input type="text" name="phone" value="{{ old('phone') ? old('phone') : $editUser->phone}}" class="form-control" id="phone">
                    @error('phone')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
                
                
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') ? old('email') : $editUser->email }}" class="form-control" id="email">
                    @error('email')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" value="{{ old('password') ? old('password') : $editUser->password}}" class="form-control" id="password">
                    @error('password')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="image">Ảnh đại diện </label>
                    <div class="edit-image">
                    @if($editUser->image)
                        <img src="{{asset('storage/user_images/'.$editUser->image)}}" alt="user image">
                    @endif
                        <input type="file" class="form-control " id="image" placeholder="Choose an image" name="image" >
                    </div>
                    @error('image')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" value="{{ old('address') ? old('address') : $editUser->address}}" class="form-control" id="address">
                    @error('address')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="role">Phân quyền</label>
                    <select class="custom-select" name="role" id="role">
                        <option selected disabled value="">Chọn quyền tài khoản</option>
                            @if($editUser->role === 0)
                            <option  value="0" selected >Khách hàng</option>
                            <option  value="1" >Admin</option>
                            @elseif ($editUser->role === 1)
                            <option value="0" >Khách hàng</option>
                            <option value="1" selected >Admin</option>
                            @endif
                        
                    </select>
                    @error('role')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <a href="{{ route('user.list') }}" class="btn btn-secondary" type="button">Quay lại</a>
            <button class="btn btn-primary" type="submit">Lưu lại</button>
        </form>
    </div>
</div>

@endsection