@extends('admin.layouts.app')

@section('title', 'Chi tiết đơn hàng')
@section('page-title', 'Chi tiết đơn hàng')

@section('content')
    <div class="page-header">
        <h4>Đơn hàng #{{ $order->id }}</h4>
        <div>
            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-warning">
                <i class="bi bi-pencil-square me-1"></i> Cập nhật trạng thái
            </a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Quay lại
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card table-card h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold">Thông tin đơn hàng</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th class="text-muted" width="150">Mã đơn hàng</th>
                            <td class="fw-bold">#{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Trạng thái</th>
                            <td>
                                @switch($order->status)
                                    @case('pending')
                                        <span class="badge bg-warning badge-status">Chờ xử lý</span>
                                        @break
                                    @case('processing')
                                        <span class="badge bg-info badge-status">Đang xử lý</span>
                                        @break
                                    @case('shipped')
                                        <span class="badge bg-primary badge-status">Đang giao</span>
                                        @break
                                    @case('completed')
                                        <span class="badge bg-success badge-status">Hoàn thành</span>
                                        @break
                                    @case('cancelled')
                                        <span class="badge bg-danger badge-status">Đã hủy</span>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">Tổng tiền</th>
                            <td class="fw-bold text-primary fs-5">
                                {{ number_format($order->total_amount, 0, ',', '.') }} ₫
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">Ngày tạo</th>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card table-card h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold">Thông tin khách hàng</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th class="text-muted" width="150">Tên</th>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Email</th>
                            <td>{{ $order->user->email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Điện thoại</th>
                            <td>{{ $order->user->phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Địa chỉ</th>
                            <td>{{ $order->user->address ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Items -->
    <div class="card table-card">
        <div class="card-header bg-white py-3">
            <h6 class="mb-0 fw-bold">Chi tiết sản phẩm</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</td>
                                <td>{{ number_format($item->price, 0, ',', '.') }} ₫</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="fw-semibold">
                                    {{ number_format($item->price * $item->quantity, 0, ',', '.') }} ₫
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-light">
                            <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                            <td class="fw-bold text-primary fs-5">
                                {{ number_format($order->total_amount, 0, ',', '.') }} ₫
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
