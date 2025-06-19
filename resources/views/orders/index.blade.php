@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Danh sách đơn hàng</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-6">
            <form method="GET" action="{{ route('orders.index') }}" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Tìm theo ID hoặc tên khách hàng..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Tìm</button>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('orders.create') }}" class="btn btn-primary">+ Thêm đơn hàng</a>
        </div>
    </div>

    @if ($orders->isEmpty())
        <div class="alert alert-info">
            {{ request('search') ? 'Không tìm thấy đơn hàng phù hợp.' : 'Chưa có đơn hàng nào.' }}
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Ngày đặt hàng</th>
                        <th style="width: 180px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer?->name ?? '-' }}</td>
                            <td>{{ number_format($order->total_amount, 0, ',', '.') }} đ</td>
                            <td>{{ $order->order_date }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">Chi tiết</a>
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xác nhận muốn xoá?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
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
