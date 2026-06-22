@extends('admin.layouts.app')

@section('title', 'Danh sách đơn hàng')
@section('page-title', 'Quản lý đơn hàng')

@section('content')
    <div class="page-header">
        <h4>Danh sách đơn hàng</h4>
        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tạo đơn hàng
        </a>
    </div>

    <div class="card table-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="80">Mã ĐH</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th width="180" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td class="fw-bold">#{{ $order->id }}</td>
                                <td>
                                    <span class="fw-semibold">{{ $order->user->name ?? 'N/A' }}</span>
                                    <br>
                                    <small class="text-muted">{{ $order->user->email ?? '' }}</small>
                                </td>
                                <td class="fw-semibold text-primary">
                                    {{ number_format($order->total_amount, 0, ',', '.') }} ₫
                                </td>
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
                                <td class="text-center">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="btn btn-sm btn-outline-info" title="Xem" aria-label="Xem đơn hàng">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.orders.edit', $order) }}"
                                       class="btn btn-sm btn-outline-warning" title="Sửa" aria-label="Sửa đơn hàng">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.orders.destroy', $order) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa" aria-label="Xóa đơn hàng">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Chưa có đơn hàng nào.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($orders->hasPages())
            <div class="card-footer bg-white d-flex justify-content-center py-3">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
