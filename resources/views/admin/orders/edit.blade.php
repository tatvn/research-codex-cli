@extends('admin.layouts.app')

@section('title', 'Cập nhật đơn hàng')
@section('page-title', 'Cập nhật đơn hàng')

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Trạng thái đơn hàng #{{ $order->id }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="status">Thay đổi trạng thái</label>
                            <select id="status" name="status" class="form-select">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đang giao</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Hủy đơn hàng</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Cập nhật trạng thái</button>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-light-secondary ms-2">Xem chi tiết</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thông tin khách hàng</h4>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label class="fw-bold">Họ tên:</label>
                        <span>{{ $order->user->name ?? 'N/A' }}</span>
                    </div>
                    <div class="mb-2">
                        <label class="fw-bold">Email:</label>
                        <span>{{ $order->user->email ?? 'N/A' }}</span>
                    </div>
                    <div class="mb-2">
                        <label class="fw-bold">Tổng tiền đơn hàng:</label>
                        <span class="text-primary fw-bold">{{ number_format($order->total_amount, 0, ',', '.') }} ₫</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
