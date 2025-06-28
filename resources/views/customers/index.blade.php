@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Danh sách khách hàng</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-6">
            <form method="GET" action="{{ route('customers.index') }}" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Tìm tên, email hoặc sđt..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Tìm</button>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('customers.create') }}" class="btn btn-primary">+ Thêm khách hàng mới</a>
        </div>
    </div>

    @if ($customers->isEmpty())
        <div class="alert alert-info">
            {{ request('search') ? 'Không tìm thấy khách hàng phù hợp.' : 'Chưa có khách hàng nào.' }}
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên Khách Hàng</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col" style="width: 160px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $index => $customer)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone ?? '-' }}</td>
                            <td>{{ $customer->address ?? '-' }}</td>
                            <td>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xác nhận muốn xóa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Xóa</button>
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
