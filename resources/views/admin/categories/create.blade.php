@extends('admin.layouts.app')

@section('title', 'Thêm loại sản phẩm')
@section('page-title', 'Thêm loại sản phẩm mới')

@section('content')
    <div class="page-header">
        <h4>Thêm loại sản phẩm mới</h4>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Quay lại
        </a>
    </div>

    <div class="card table-card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Tên loại sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label fw-semibold">Slug <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                           id="slug" name="slug" value="{{ old('slug') }}" required>
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label fw-semibold">Trạng thái <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror"
                            id="status" name="status" required>
                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tắt</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>
                <div class="text-end">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
