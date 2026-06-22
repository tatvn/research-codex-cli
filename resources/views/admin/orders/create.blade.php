@extends('admin.layouts.app')

@section('title', 'Tạo đơn hàng')
@section('page-title', 'Tạo đơn hàng mới')

@section('content')
    <div class="page-header">
        <h4>Tạo đơn hàng mới</h4>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Quay lại
        </a>
    </div>

    <div class="card table-card">
        <div class="card-body">
            <form action="{{ route('admin.orders.store') }}" method="POST">
                @csrf

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="user_id" class="form-label fw-semibold">Khách hàng <span class="text-danger">*</span></label>
                            <select class="form-select @error('user_id') is-invalid @enderror"
                                    id="user_id" name="user_id" required>
                                <option value="">-- Chọn khách hàng --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                            {{ old('user_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} ({{ $customer->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Trạng thái <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                <option value="shipped" {{ old('status') == 'shipped' ? 'selected' : '' }}>Đang giao</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <h6 class="fw-bold mb-3">Sản phẩm trong đơn hàng</h6>
                <div id="order-items">
                    <div class="row mb-3 order-item-row">
                        <div class="col-md-5">
                            <select class="form-select" name="items[0][product_id]" required>
                                <option value="">-- Chọn sản phẩm --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                        {{ $product->name }} - {{ number_format($product->price, 0, ',', '.') }} ₫
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="items[0][quantity]"
                                   placeholder="Số lượng" min="1" value="1" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="items[0][price]"
                                   placeholder="Đơn giá" min="0" step="1000" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-outline-danger btn-remove-item" disabled>
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-primary btn-sm mb-4" id="btn-add-item">
                    <i class="bi bi-plus-lg me-1"></i> Thêm sản phẩm
                </button>

                <hr>
                <div class="text-end">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Tạo đơn hàng
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let itemIndex = 1;

    document.getElementById('btn-add-item').addEventListener('click', function () {
        const container = document.getElementById('order-items');
        const row = document.querySelector('.order-item-row').cloneNode(true);

        row.querySelectorAll('select, input').forEach(function (el) {
            el.name = el.name.replace(/\[\d+\]/, '[' + itemIndex + ']');
            if (el.tagName === 'SELECT') el.selectedIndex = 0;
            if (el.tagName === 'INPUT' && el.type === 'number') {
                el.value = el.name.includes('quantity') ? '1' : '';
            }
        });

        const removeBtn = row.querySelector('.btn-remove-item');
        removeBtn.disabled = false;
        removeBtn.addEventListener('click', function () {
            row.remove();
        });

        container.appendChild(row);
        itemIndex++;
    });
</script>
@endpush
