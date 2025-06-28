@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Danh sách sản phẩm</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-6">
            <form method="GET" action="{{ route('products.index') }}" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Tìm tên hoặc mô tả sản phẩm..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Tìm</button>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('products.create') }}" class="btn btn-primary">+ Thêm sản phẩm mới</a>
        </div>
    </div>

    @if ($products->isEmpty())
        <div class="alert alert-info">
            {{ request('search') ? 'Không tìm thấy sản phẩm phù hợp.' : 'Chưa có sản phẩm nào.' }}
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Mô tả</th>
                        <th style="width: 160px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->description ?? '-' }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Xác nhận muốn xoá?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Xoá</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ url('/') }}" class="btn btn-outline-secondary">
            ← Về trang chủ
        </a>
    </div>
</div>
@endsection
