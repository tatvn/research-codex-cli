@extends('admin.layouts.app')

@section('title', 'Chi tiết loại sản phẩm')
@section('page-title', 'Chi tiết loại sản phẩm')

@section('content')
    <div class="page-header">
        <h4>{{ $category->name }}</h4>
        <div>
            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                <i class="bi bi-pencil-square me-1"></i> Sửa
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Quay lại
            </a>
        </div>
    </div>

    <div class="card table-card mb-4">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200" class="text-muted">ID</th>
                    <td>#{{ $category->id }}</td>
                </tr>
                <tr>
                    <th class="text-muted">Tên loại</th>
                    <td class="fw-semibold">{{ $category->name }}</td>
                </tr>
                <tr>
                    <th class="text-muted">Slug</th>
                    <td><code>{{ $category->slug }}</code></td>
                </tr>
                <tr>
                    <th class="text-muted">Trạng thái</th>
                    <td>
                        @if ($category->status)
                            <span class="badge bg-success badge-status">Hoạt động</span>
                        @else
                            <span class="badge bg-secondary badge-status">Tắt</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="text-muted">Số sản phẩm</th>
                    <td>{{ $category->products->count() }}</td>
                </tr>
            </table>
        </div>
    </div>

    @if ($category->products->count() > 0)
        <div class="card table-card">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Sản phẩm thuộc danh mục</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category->products as $product)
                                <tr>
                                    <td>#{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ number_format($product->price, 0, ',', '.') }} ₫</td>
                                    <td>
                                        @if ($product->status)
                                            <span class="badge bg-success badge-status">Đang bán</span>
                                        @else
                                            <span class="badge bg-secondary badge-status">Ngừng bán</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection
