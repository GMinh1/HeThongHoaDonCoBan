@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Chi tiết đơn hàng #{{ $order->id }}</h2>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>Thông tin khách hàng</strong>
        </div>
        <div class="card-body">
            <p><strong>Tên:</strong> {{ $order->customer->name }}</p>
            <p><strong>Email:</strong> {{ $order->customer->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->customer->phone ?? 'Chưa có' }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->customer->address ?? 'Chưa có'}}</p>
            <p><strong>Ngày đặt hàng:</strong> {{ $order->order_date }}</p>
            <p><strong>Tổng tiền:</strong> 
                <span class="badge bg-success fs-5">
                    {{ number_format($order->total_amount, 0, ',', '.') }} đ
                </span>
            </p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <strong>Sản phẩm đã mua</strong>
        </div>
        <div class="card-body p-0">
            @if ($order->products->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ number_format($product->pivot->price, 0, ',', '.') }} đ</td>
                                    <td>{{ number_format($product->pivot->price * $product->pivot->quantity, 0, ',', '.') }} đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="p-3">Không có sản phẩm nào trong đơn hàng này.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary mt-4">
        ← Quay lại danh sách
    </a>
</div>
@endsection
