@extends('admin.layouts.app')

@section('title', 'Cập nhật khách hàng')
@section('page-title', 'Cập nhật khách hàng')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Thông tin khách hàng: {{ $customer->name }}</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{ route('admin.customers.update', $customer) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">Họ và tên</label>
                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name', $customer->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email', $customer->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                           name="phone" value="{{ old('phone', $customer->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" id="address" class="form-control @error('address') is-invalid @enderror"
                                           name="address" value="{{ old('address', $customer->address) }}">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Cập nhật</button>
                                <a href="{{ route('admin.customers.index') }}" class="btn btn-light-secondary me-1 mb-1">Quay lại</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
