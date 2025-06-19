@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h2 class="mb-4 text-success">Đăng nhập thành công!</h2>
    <p class="lead">Bạn sẽ được chuyển hướng về trang chủ trong vài giây...</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Về trang chủ ngay</a>
</div>

{{-- Tự động chuyển trang sau 3 giây --}}
<script>
    setTimeout(() => {
        window.location.href = "{{ url('/') }}";
    }, 3000);
</script>
@endsection
