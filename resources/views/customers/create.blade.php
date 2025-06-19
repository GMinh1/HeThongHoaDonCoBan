@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Thêm khách hàng mới</h2>

    <form action="{{ route('customers.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-3">​​
            <label for="email" class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                   id="phone" name="phone" value="{{ old('phone') }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <textarea class="form-control @error('address') is-invalid @enderror"
                      id="address" name="address" rows="3">{{ old('address') }}</textarea>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Hủy</a>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
@endsection
