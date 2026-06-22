@extends('admin.layouts.app')

@section('title', 'Danh sách khách hàng')
@section('page-title', 'Quản lý khách hàng')

@section('content')
    <div class="page-header">
        <h4>Danh sách khách hàng</h4>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Thêm khách hàng
        </a>
    </div>

    <div class="card table-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Tên khách hàng</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Số đơn hàng</th>
                            <th width="180" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td class="fw-bold">#{{ $customer->id }}</td>
                                <td class="fw-semibold">{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $customer->orders_count }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.customers.show', $customer) }}"
                                       class="btn btn-sm btn-outline-info" title="Xem" aria-label="Xem khách hàng">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.customers.edit', $customer) }}"
                                       class="btn btn-sm btn-outline-warning" title="Sửa" aria-label="Sửa khách hàng">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.customers.destroy', $customer) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa khách hàng này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa" aria-label="Xóa khách hàng">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Chưa có khách hàng nào.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($customers->hasPages())
            <div class="card-footer bg-white d-flex justify-content-center py-3">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
@endsection
