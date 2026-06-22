@extends('admin.layouts.app')

@section('title', 'Chi tiết đơn hàng')
@section('page-title', 'Chi tiết đơn hàng')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Thông tin đơn hàng</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="fw-bold">Mã đơn hàng:</label>
                        <p class="h5">#{{ $order->id }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Ngày đặt:</label>
                        <p>{{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Trạng thái:</label>
                        <p>
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
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Tổng tiền:</label>
                        <p class="h5 text-primary fw-bold">{{ number_format($order->total_amount, 0, ',', '.') }} ₫</p>
                    </div>
                    <hr>
                    <h5>Khách hàng</h5>
                    <p class="mb-1"><strong>Tên:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                    <div class="d-grid gap-2 mt-4">
                        <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-warning">Cập nhật trạng thái</a>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-light-secondary">Quay lại danh sách</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Sản phẩm trong đơn hàng</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Đơn giá</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name ?? 'Sản phẩm đã bị xóa' }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">{{ number_format($item->price, 0, ',', '.') }} ₫</td>
                                        <td class="text-end fw-bold">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} ₫</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end h5">Tổng cộng:</th>
                                    <th class="text-end h5 text-primary">{{ number_format($order->total_amount, 0, ',', '.') }} ₫</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
