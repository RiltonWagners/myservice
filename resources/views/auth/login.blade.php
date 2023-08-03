@extends('layouts.app')

@section('content')
<style>
		body {
			background-color: #f7f7f7;
		}
		.login-form {
			margin-top: 80px;
			max-width: 400px;
			padding: 15px;
			margin: auto;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0px 3px 20px rgba(0, 0, 0, 0.1);
		}
		.login-form h2 {
			text-align: center;
			color: #fe5002;
			margin-bottom: 30px;
		}
		.login-form .form-control {
			background-color: #f7f7f7;
			border-radius: 3px;
			border: none;
			box-shadow: none;
			padding: 10px;
			font-size: 14px;
			margin-bottom: 15px;
			height: auto;
		}
		.login-form .form-control:focus {
			background-color: #fff;
			border: 2px solid #fe5002;
			box-shadow: none;
		}
		.login-form .btn {
			background-color: #fe5002;
			border-color: #fe5002;
			color: #fff;
			border-radius: 3px;
			padding: 10px;
			font-size: 14px;
			width: 100%;
			margin-bottom: 20px;
			text-transform: uppercase;
		}
		.login-form .btn:hover {
			background-color: #fff;
			color: #fe5002;
			border-color: #fe5002;
		}
		.login-form .forgot-link {
			color: #fe5002;
			text-decoration: none;
			font-size: 12px;
		}
		.login-form .forgot-link:hover {
			color: #fe5002;
			text-decoration: underline;
		}

        @media (min-width: 768px) {
			.login-form {
				margin-top: 120px;
				margin-bottom: 120px;
				max-width: 480px;
			}
		}

        @media (max-width: 768px) {
			.login-form {
				margin-bottom: 120px;
				max-width: 480px;
			}
		}

	</style>
    <div class="container">
		<div class="row">
            <div class="col-md-12 col-md-offset-4 col-sm-12 col-sm-offset-3">
                <form class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf
					<h2>Login</h2>
					<div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Senha" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					</div>
					<button type="submit" class="btn">Entrar</button>
					<div class="text-center">
                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                {{ __('Esqueceu a senha?') }}
                            </a>
                        @endif
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
