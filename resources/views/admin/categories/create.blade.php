@extends('admin.layouts.app')

@section('title', 'Thêm loại sản phẩm')
@section('page-title', 'Thêm loại sản phẩm')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Thông tin loại sản phẩm</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Tên loại sản phẩm</label>
                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" placeholder="Nhập tên loại sản phẩm">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="slug">Slug (Để trống sẽ tự tạo)</label>
                                    <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror"
                                           name="slug" value="{{ old('slug') }}" placeholder="slug-san-pham">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select id="status" name="status" class="form-select">
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Hoạt động</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tắt</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Lưu</button>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-light-secondary me-1 mb-1">Quay lại</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
