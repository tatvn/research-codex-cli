@extends('admin.layouts.app')

@section('title', 'Danh sách loại sản phẩm')
@section('page-title', 'Quản lý loại sản phẩm')

@section('content')
    <div class="page-header">
        <h4>Danh sách loại sản phẩm</h4>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Thêm loại sản phẩm
        </a>
    </div>

    <div class="card table-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Tên loại</th>
                            <th>Slug</th>
                            <th>Số sản phẩm</th>
                            <th>Trạng thái</th>
                            <th width="180" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td class="fw-bold">#{{ $category->id }}</td>
                                <td class="fw-semibold">{{ $category->name }}</td>
                                <td><code>{{ $category->slug }}</code></td>
                                <td>
                                    <span class="badge bg-info">{{ $category->products_count }}</span>
                                </td>
                                <td>
                                    @if ($category->status)
                                        <span class="badge bg-success badge-status">Hoạt động</span>
                                    @else
                                        <span class="badge bg-secondary badge-status">Tắt</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.categories.show', $category) }}"
                                       class="btn btn-sm btn-outline-info" title="Xem">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="btn btn-sm btn-outline-warning" title="Sửa">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại sản phẩm này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Chưa có loại sản phẩm nào.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($categories->hasPages())
            <div class="card-footer bg-white d-flex justify-content-center py-3">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
