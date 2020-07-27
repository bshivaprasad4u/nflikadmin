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
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                @error('email')
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <form method="POST" action="{{ route('admin.password.email') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
                <p class="mt-3 mb-1">
                    <a href="{{ route('admin.login') }}">Login</a>
                </p>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    @include('adminlte.includes.foot')

</body>

</html>