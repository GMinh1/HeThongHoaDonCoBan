@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Chỉnh sửa đơn hàng</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.update', $order->id) }}" method="POST" id="orderForm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Khách hàng</label>
            <select class="form-select" name="customer_id" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="products-container">
            @foreach($order->products as $index => $product)
            <div class="row mb-3 product-row">
                <div class="col-md-6">
                    <label class="form-label">Sản phẩm</label>
                    <select class="form-select product-select" name="products[{{ $index }}][product_id]" required>
                        <option value="">-- Chọn sản phẩm --</option>
                        @foreach($products as $p)
                            <option value="{{ $p->id }}"
                                data-price="{{ $p->price }}"
                                {{ $product->pivot->product_id == $p->id ? 'selected' : '' }}>
                                {{ $p->name }} - {{ number_format($p->price, 0, ',', '.') }} đ
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Số lượng</label>
                    <input type="number" class="form-control quantity-input"
                           name="products[{{ $index }}][quantity]" value="{{ $product->pivot->quantity }}" min="1" required>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-row">Xoá</button>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" id="addRow" class="btn btn-secondary mb-3">+ Thêm sản phẩm</button>

        <div class="mb-3">
            <label class="form-label">Tổng tiền</label>
            <input type="text" name="total_amount" class="form-control" id="totalAmount" readonly>
            <small id="formattedAmount" class="text-muted d-block mt-1"></small>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày đặt hàng</label>
            <input type="date" class="form-control" name="order_date" value="{{ $order->order_date }}" required>
        </div>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Huỷ</a>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let rowIndex = {{ count($order->products) }};

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.product-row').forEach(row => {
                const price = parseFloat(row.querySelector('.product-select option:checked')?.dataset.price || 0);
                const quantity = parseInt(row.querySelector('.quantity-input').value) || 0;
                total += price * quantity;
            });
            document.getElementById('totalAmount').value = total.toFixed(0);
            document.getElementById('formattedAmount').innerText = total.toLocaleString('vi-VN') + ' đ';
        }

        document.getElementById('addRow').addEventListener('click', function () {
            const container = document.getElementById('products-container');
            const newRow = container.querySelector('.product-row').cloneNode(true);

            newRow.querySelector('.product-select').setAttribute('name', `products[${rowIndex}][product_id]`);
            newRow.querySelector('.quantity-input').setAttribute('name', `products[${rowIndex}][quantity]`);
            newRow.querySelector('.product-select').value = '';
            newRow.querySelector('.quantity-input').value = 1;

            container.appendChild(newRow);
            rowIndex++;
            calculateTotal();
        });

        document.getElementById('products-container').addEventListener('change', calculateTotal);
        document.getElementById('products-container').addEventListener('input', calculateTotal);

        document.getElementById('products-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-row')) {
                const rows = document.querySelectorAll('.product-row');
                if (rows.length > 1) {
                    e.target.closest('.product-row').remove();
                    calculateTotal();
                }
            }
        });

        calculateTotal();
    });
</script>
@endsection
