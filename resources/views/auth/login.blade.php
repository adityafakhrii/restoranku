<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('dashboard') }}"><img src="https://apps.codepolitan.com/sites/learn/uploads/original/2/logo-codepolitan-originals.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Log in with your registered credentials.</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <x-text-input id="email" class="form-control form-control-xl" type="email" name="email" :value="old('email')" required autofocus placeholder="Email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <x-text-input id="password" class="form-control form-control-xl" type="password" name="password" required placeholder="Password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        {{-- <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="remember_me">
                            <label class="form-check-label text-gray-600" for="remember_me">
                                {{ __('Remember me') }}
                            </label>
                        </div> --}}

                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            {{ __('Log in') }}
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
</body>

</html>
