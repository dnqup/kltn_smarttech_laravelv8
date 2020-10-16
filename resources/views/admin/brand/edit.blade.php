@extends('admin.layouts.master')
@section('content')
<div class="content-right-main">
    <div class="container">
        <section class="table-headding">
            <h3>Cập nhật nhãn hiệu</h3>
        </section>
        <form method="POST" action="{{ route('brand.update', $editBrand->id) }}" enctype="multipart/form-data">
        @csrf
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="brand_name">Tên nhãn hiệu</label>
                    <input type="text" name="brand_name" value="{{ old('brand_name') ? old('brand_name') : $editBrand->brand_name }}" class="form-control" id="brand_name">
                    @error('brand_name')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
                
            </div>
            <div class="form-group">
                
                <label for="image">Hình ảnh </label>
                <div class="edit-image">
                    <img src="{{asset('storage/brand_images/'.$editBrand->image)}}" alt="brand image">
                    <input type="file" class="form-control " id="image" placeholder="Choose an image" name="image" >
                </div>
                
                @error('image')
                    <small class="alert-danger form-text text-muted">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <div class="form-check">
                    @if ($editBrand->status === 1)
                        <input class="form-check-input" name="status" type="checkbox" id="status" value="1" checked >
                    @else
                        <input class="form-check-input" name="status" type="checkbox" id="status">
                    @endif
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