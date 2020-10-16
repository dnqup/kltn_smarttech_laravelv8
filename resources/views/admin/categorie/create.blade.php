@extends('admin.layouts.master')
@section('content')
<div class="content-right-main">
    <div class="container">
        <section class="table-headding">
            <h3>Thêm mới danh mục</h3>
        </section>
        <form method="POST" action="{{ route('categorie.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="categorie_name">Tên danh mục</label>
                    <input type="text" name="categorie_name" value="{{ old('categorie_name') }}" class="form-control" id="categorie_name">
                    @error('categorie_name')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
                
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" name="status" value="1" type="checkbox"  id="status">
                    <label class="form-check-label" for="status">
                        Trạng thái
                    </label>
                
                </div>
            </div>
            <a href="{{ route('categorie.list') }}" class="btn btn-secondary" type="button">Quay lại</a>
            <button class="btn btn-primary" type="submit">Lưu lại</button>
        </form>
    </div>
</div>

@endsection