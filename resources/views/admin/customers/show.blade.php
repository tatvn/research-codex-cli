@extends('admin.layouts.app')

@section('title', 'Chi tiết khách hàng')
@section('page-title', 'Chi tiết khách hàng')

@section('content')
    <div class="page-header">
        <h4>{{ $customer->name }}</h4>
        <div>
            <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-warning">
                <i class="bi bi-pencil-square me-1"></i> Sửa
            </a>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Quay lại
            </a>
        </div>
    </div>

    <div class="card table-card mb-4">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200" class="text-muted">ID</th>
                    <td>#{{ $customer->id }}</td>
                </tr>
                <tr>
                    <th class="text-muted">Họ tên</th>
                    <td class="fw-semibold">{{ $customer->name }}</td>
                </tr>
                <tr>
                    <th class="text-muted">Email</th>
                    <td>{{ $customer->email }}</td>
                </tr>
                <tr>
                    <th class="text-muted">Điện thoại</th>
                    <td>{{ $customer->phone ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="text-muted">Địa chỉ</th>
                    <td>{{ $customer->address ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="text-muted">Ngày đăng ký</th>
                    <td>{{ $customer->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>

    @if ($customer->orders->count() > 0)
        <div class="card table-card">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Lịch sử đơn hàng ({{ $customer->orders->count() }})</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Mã ĐH</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer->orders as $order)
                                <tr>
                                    <td class="fw-bold">#{{ $order->id }}</td>
                                    <td>{{ number_format($order->total_amount, 0, ',', '.') }} ₫</td>
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
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}"
                                           class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i> Xem
                                        </a>
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
