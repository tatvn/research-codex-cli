@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-tags-fill"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 small">Loại sản phẩm</p>
                        <h4 class="mb-0 fw-bold">{{ number_format($stats['totalCategories']) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 small">Sản phẩm</p>
                        <h4 class="mb-0 fw-bold">{{ number_format($stats['totalProducts']) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-cart-check-fill"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 small">Đơn hàng</p>
                        <h4 class="mb-0 fw-bold">{{ number_format($stats['totalOrders']) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-info bg-opacity-10 text-info">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 small">Khách hàng</p>
                        <h4 class="mb-0 fw-bold">{{ number_format($stats['totalCustomers']) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue & Pending -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 small">Tổng doanh thu</p>
                        <h4 class="mb-0 fw-bold">{{ number_format($stats['totalRevenue'], 0, ',', '.') }} ₫</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 small">Đơn hàng chờ xử lý</p>
                        <h4 class="mb-0 fw-bold">{{ number_format($stats['pendingOrders']) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card table-card">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">Đơn hàng gần đây</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentOrders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Chưa có đơn hàng nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
