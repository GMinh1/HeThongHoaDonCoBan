<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Invoice System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .btn-outline-primary,
        .btn-outline-success,
        .btn-outline-warning {
            color: #202938 !important;
            border-color: #202938 !important;
        }

        .btn-outline-primary:hover,
        .btn-outline-success:hover,
        .btn-outline-warning:hover {
            background-color: #202938 !important;
            color: #fff !important;
            border-color: #202938 !important;
        }

        .btn-primary {
            background-color: #202938 !important;
            border-color: #202938 !important;
        }

        .btn-primary:hover {
            background-color: #10151c !important;
            border-color: #10151c !important;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container py-5">

        {{-- Đăng nhập / Đăng ký / Xin chào --}}
        <div class="d-flex justify-content-end mb-4">
            @auth
                <div class="me-3">
                    Xin chào, <strong>{{ Auth::user()->name }}</strong>!
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Đăng xuất</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary me-2">Đăng nhập</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Đăng ký</a>
            @endauth
        </div>

        <div class="text-center mb-4">
            <h1 class="display-4">Hệ Thống Quản Lý Hóa Đơn</h1>
            <p class="lead">Chào mừng bạn đến với hệ thống quản lý khách hàng, sản phẩm và đơn hàng.</p>
        </div>

        {{-- Chỉ hiển thị sau khi đăng nhập --}}
        @auth
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <a href="{{ route('customers.index') }}" class="btn btn-outline-primary w-100">Quản lý Khách hàng</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('products.index') }}" class="btn btn-outline-success w-100">Quản lý Sản phẩm</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('orders.index') }}" class="btn btn-outline-warning w-100">Quản lý Đơn hàng</a>
            </div>
        </div>
        @endauth
    </div>

</body>
</html>
