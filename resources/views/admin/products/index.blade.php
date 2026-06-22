@extends('admin.layouts.app')

@section('title', 'Danh sách sản phẩm')
@section('page-title', 'Quản lý sản phẩm')

@section('content')
    <div class="page-header">
        <h4>Danh sách sản phẩm</h4>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Thêm sản phẩm mới
        </a>
    </div>

    <div class="card table-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th width="180" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td class="fw-bold">#{{ $product->id }}</td>
                                <td>
                                    <span class="fw-semibold">{{ $product->name }}</span>
                                    <br>
                                    <small class="text-muted">{{ $product->slug }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $product->category->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="fw-semibold text-primary">
                                    {{ number_format($product->price, 0, ',', '.') }} ₫
                                </td>
                                <td>
                                    @if ($product->stock_quantity > 10)
                                        <span class="text-success fw-semibold">{{ $product->stock_quantity }}</span>
                                    @elseif ($product->stock_quantity > 0)
                                        <span class="text-warning fw-semibold">{{ $product->stock_quantity }}</span>
                                    @else
                                        <span class="text-danger fw-semibold">Hết hàng</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->status)
                                        <span class="badge bg-success badge-status">Đang bán</span>
                                    @else
                                        <span class="badge bg-secondary badge-status">Ngừng bán</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.products.show', $product) }}"
                                       class="btn btn-sm btn-outline-info" title="Xem" aria-label="Xem sản phẩm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="btn btn-sm btn-outline-warning" title="Sửa" aria-label="Sửa sản phẩm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa" aria-label="Xóa sản phẩm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Chưa có sản phẩm nào.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($products->hasPages())
            <div class="card-footer bg-white d-flex justify-content-center py-3">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
