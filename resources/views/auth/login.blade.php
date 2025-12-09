@extends('client.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Đăng nhập</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="client-validate">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="invalid-feedback client-error" data-for="email" style="display:none;" aria-live="polite"></div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="invalid-feedback client-error" data-for="password" style="display:none;" aria-live="polite"></div>
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label class="form-check-label" for="remember_me">
                                Ghi nhớ đăng nhập
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Đăng nhập
                            </button>
                        </div>

                        <div class="mt-3 text-center">
                            <a href="{{ route('register') }}">Chưa có tài khoản? Đăng ký</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
