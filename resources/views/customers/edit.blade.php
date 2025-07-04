@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Cập nhật thông tin khách hàng</h2>

    <form action="{{ route('customers.update', $customer) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name', $customer->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" value="{{ old('email', $customer->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                   id="phone" name="phone" value="{{ old('phone', $customer->phone) }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <textarea class="form-control @error('address') is-invalid @enderror"
                      id="address" name="address" rows="3">{{ old('address', $customer->address) }}</textarea>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Hủy</a>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
