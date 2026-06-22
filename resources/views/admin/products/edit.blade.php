@extends('admin.layouts.app')

@section('title', 'Sửa sản phẩm')
@section('page-title', 'Sửa sản phẩm')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Cập nhật thông tin: {{ $product->name }}</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{ route('admin.products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm</label>
                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name', $product->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                                              name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="category_id">Loại sản phẩm</label>
                                    <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Giá bán (₫)</label>
                                    <input type="number" id="price" class="form-control @error('price') is-invalid @enderror"
                                           name="price" value="{{ old('price', $product->price) }}" step="1000">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock_quantity">Số lượng tồn kho</label>
                                    <input type="number" id="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror"
                                           name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}">
                                    @error('stock_quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select id="status" name="status" class="form-select">
                                        <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>Đang bán</option>
                                        <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>Ngừng bán</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Cập nhật</button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-light-secondary me-1 mb-1">Quay lại</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
