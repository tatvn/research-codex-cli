@extends('admin.layouts.app')

@section('title', 'Chi tiết loại sản phẩm')
@section('page-title', 'Chi tiết loại sản phẩm')

@section('content')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Thông tin chung</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="fw-bold">Tên loại:</label>
                        <p>{{ $category->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Slug:</label>
                        <p><code>{{ $category->slug }}</code></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Trạng thái:</label>
                        <p>
                            @if ($category->status)
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-secondary">Tắt</span>
                            @endif
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Ngày tạo:</label>
                        <p>{{ $category->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">Sửa thông tin</a>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light-secondary">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Sản phẩm thuộc loại này</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Tồn kho</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($category->products as $product)
                                    <tr>
                                        <td>#{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ number_format($product->price, 0, ',', '.') }} ₫</td>
                                        <td>{{ $product->stock_quantity }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Chưa có sản phẩm nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
