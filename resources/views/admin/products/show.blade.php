@extends('admin.layouts.app')

@section('title', 'Chi tiết sản phẩm')
@section('page-title', 'Chi tiết sản phẩm')

@section('content')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Thông tin cơ bản</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3 text-center">
                        <div class="bg-light p-4 rounded">
                            <i class="bi bi-box-seam" style="font-size: 4rem; color: #435ebe;"></i>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Tên sản phẩm:</label>
                        <p class="h5">{{ $product->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Giá bán:</label>
                        <p class="text-primary fw-bold h5">{{ number_format($product->price, 0, ',', '.') }} ₫</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Loại sản phẩm:</label>
                        <p><span class="badge bg-light-primary text-primary">{{ $product->category->name ?? 'N/A' }}</span></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Số lượng trong kho:</label>
                        <p>{{ $product->stock_quantity }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Trạng thái:</label>
                        <p>
                            @if ($product->status)
                                <span class="badge bg-success">Đang bán</span>
                            @else
                                <span class="badge bg-secondary">Ngừng bán</span>
                            @endif
                        </p>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Sửa sản phẩm</a>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-light-secondary">Quay lại danh sách</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Mô tả sản phẩm</h4>
                </div>
                <div class="card-body">
                    <div class="bg-light p-3 rounded">
                        {!! nl2br(e($product->description)) ?: '<span class="text-muted">Không có mô tả.</span>' !!}
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4>Lịch sử bán hàng (Gần đây)</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Số lượng</th>
                                    <th>Giá bán lúc đó</th>
                                    <th>Ngày</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($product->orderItems()->with('order.user')->latest()->take(5)->get() as $item)
                                    <tr>
                                        <td>#{{ $item->order_id }}</td>
                                        <td>{{ $item->order->user->name ?? 'N/A' }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price, 0, ',', '.') }} ₫</td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">Sản phẩm này chưa có giao dịch nào.</td>
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
