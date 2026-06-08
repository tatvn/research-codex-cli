@extends('layouts.admin')

@section('title', 'Edit Product')
@section('heading', 'Edit Product')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', $product->quantity) }}" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="mt-2" width="100">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="status" id="status" {{ $product->status ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Active</label>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
