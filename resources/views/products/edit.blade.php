@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Cập nhật sản phẩm</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả (tùy chọn)</label>
            <textarea class="form-control" name="description">{{ old('description', $product->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
