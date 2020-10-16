@extends('admin.layouts.master')
@section('content')
<div class="content-right-main">
    <div class="container">
        <section class="table-headding">
            <h3>Thêm mới sản phẩm</h3>
        </section>
        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="product_name">Tên sản phẩm</label>
                    <input type="text" name="product_name" value="{{ old('product_name') }}" class="form-control" id="product_name">
                    @error('product_name')
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


            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="description">Mô tả</label>
                    <textarea type="text" name="description" value="" class="form-control" id="description">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="price">Giá niêm yết</label>
                    <input type="text" name="price" value="{{ old('price') }}" class="form-control" id="price">
                    @error('price')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="promotion_price">Giá khuyến mãi</label>
                    <input type="text" name="promotion_price" value="{{ old('promotion_price') }}" class="form-control" id="promotion_price">
                    @error('promotion_price')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                
                    <label for="id_categorie">Danh mục</label>
                    <select class="custom-select" name="id_categorie" id="id_categorie">
                        <option selected disabled value="">Chọn danh mục</option>
                        @if(count($categories))
                            @foreach($categories as $categorie)
                                <option 
                                    value="{{$categorie->id}}" 
                                    {{(old('id_categorie') && old('id_categorie')==$categorie->id )?'selected':''}}
                                >{{$categorie->categorie_name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('id_categorie')
                        <small class="alert-danger form-text text-muted">{{ $message }}</small>
                    @enderror
                    
                </div>
                <div class="col-md-3 mb-3">
                    <label for="id_brand">Nhãn hiệu</label>
                    <select class="custom-select" name="id_brand" id="id_brand">
                        <option selected disabled value="">Chọn nhãn hiệu</option>
                        @if(count($brands))
                            @foreach($brands as $brand)
                                <option 
                                    value="{{$brand->id}}" 
                                    {{(old('id_brand') && old('id_brand')==$brand->id )?'selected':''}}
                                >{{$brand->brand_name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('id_brand')
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
            <a href="{{ route('product.list') }}" class="btn btn-secondary" type="button">Quay lại</a>
            <button class="btn btn-primary" type="submit">Lưu lại</button>
        </form>
    </div>
</div>

@endsection