@extends('admin.layouts.app')

@section('title', 'Chi tiết sản phẩm')
@section('page-title', 'Chi tiết sản phẩm')

@section('content')
    <div class="page-header">
        <h4>{{ $product->name }}</h4>
        <div>
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                <i class="bi bi-pencil-square me-1"></i> Sửa
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Quay lại
            </a>
        </div>
    </div>

    <div class="card table-card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th width="200" class="text-muted">ID</th>
                            <td>#{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Tên sản phẩm</th>
                            <td class="fw-semibold">{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Slug</th>
                            <td><code>{{ $product->slug }}</code></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Danh mục</th>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $product->category->name ?? 'N/A' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">Giá</th>
                            <td class="fw-bold text-primary">
                                {{ number_format($product->price, 0, ',', '.') }} ₫
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">Số lượng tồn kho</th>
                            <td>{{ $product->stock_quantity }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Trạng thái</th>
                            <td>
                                @if ($product->status)
                                    <span class="badge bg-success badge-status">Đang bán</span>
                                @else
                                    <span class="badge bg-secondary badge-status">Ngừng bán</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">Ngày tạo</th>
                            <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if ($product->description)
                <hr>
                <h6 class="fw-bold mb-3">Mô tả sản phẩm</h6>
                <p class="text-muted">{{ $product->description }}</p>
            @endif
        </div>
    </div>
@endsection
