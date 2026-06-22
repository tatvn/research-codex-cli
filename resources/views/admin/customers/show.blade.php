@extends('admin.layouts.app')

@section('title', 'Chi tiết khách hàng')
@section('page-title', 'Chi tiết khách hàng')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-4 mt-3">
                        <div class="avatar avatar-xl bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                             style="width: 100px; height: 100px; font-size: 3rem;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    </div>
                    <h4 class="text-center">{{ $customer->name }}</h4>
                    <p class="text-muted text-center">{{ $customer->email }}</p>
                    <hr>
                    <div class="mb-3">
                        <label class="fw-bold">Số điện thoại:</label>
                        <p>{{ $customer->phone ?? 'Chưa cập nhật' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Địa chỉ:</label>
                        <p>{{ $customer->address ?? 'Chưa cập nhật' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Ngày tham gia:</label>
                        <p>{{ $customer->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-warning">Sửa thông tin</a>
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-light-secondary">Quay lại danh sách</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Lịch sử đơn hàng</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customer->orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td class="fw-bold">{{ number_format($order->total_amount, 0, ',', '.') }} ₫</td>
                                        <td>
                                            @switch($order->status)
                                                @case('pending')
                                                    <span class="badge bg-warning">Chờ xử lý</span>
                                                    @break
                                                @case('processing')
                                                    <span class="badge bg-info">Đang xử lý</span>
                                                    @break
                                                @case('shipped')
                                                    <span class="badge bg-primary">Đang giao</span>
                                                    @break
                                                @case('completed')
                                                    <span class="badge bg-success">Hoàn thành</span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="badge bg-danger">Đã hủy</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-light-info">Chi tiết</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">Khách hàng này chưa có đơn hàng nào.</td>
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
