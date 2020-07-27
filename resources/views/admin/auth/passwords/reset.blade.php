<!DOCTYPE html>
<html>
@include('adminlte.includes.head')

<body class="hold-transition login-page">
    <div class="col-md-4">
        <div class="login-logo">
            <a href="{{ url('/')}}">Nflik Admin</a>
        </div>
        <div class="card">
            <div class="card-header">Admin {{ __('Reset Password') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    @error('email')
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>

                        </div>
                        @error('password')
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
                <p class="mt-3 mb-1">
                    <a href="{{ route('admin.login') }}">Login</a>
                </p>
            </div>
        </div>
    </div>
    @include('adminlte.includes.foot')

</body>

</html>