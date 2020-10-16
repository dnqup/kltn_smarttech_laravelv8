@extends('admin.layouts.master')
@section('content')
<div class="content-right-main">
    <div class="container">
        <section class="table-headding">
            <h3>Thêm mới nhãn hiệu</h3>
        </section>
        <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="brand_name">Tên nhãn hiệu</label>
                    <input type="text" name="brand_name" value="{{ old('brand_name') }}" class="form-control" id="brand_name">
                    @error('brand_name')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
                
            </div>
            <div class="form-group">
                <label for="image">Hình ảnh </label>
                <input type="file" class="form-control" id="image" placeholder="Choose an image" name="image" >
                @error('image')
                    <small class="alert-danger form-text text-muted">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" name="status" value="1" type="checkbox"  id="status">
                    <label class="form-check-label" for="status">
                        Trạng thái
                    </label>
                
                </div>
            </div>
            <a href="{{ route('brand.list') }}" class="btn btn-secondary" type="button">Quay lại</a>
            <button class="btn btn-primary" type="submit">Lưu lại</button>
        </form>
    </div>
</div>

@endsection