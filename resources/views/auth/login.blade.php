<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ env('APP_NAME', 'Sherif Saoudi') }}</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="logo/logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="asset/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="asset/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="asset/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="asset/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="asset/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="asset/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="asset/vendor/js/helpers.js"></script>
    <script src="asset/js/config.js"></script>
</head>

<body>
    <div class="container-xxl d-flex justify-content-center align-items-center min-vh-100">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo Section -->
                        <div class="app-brand justify-content-center mb-4">
                            <a href="{{ route('login') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img width="40" src="logo/logo.png" alt="Logo" />
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">{{ __('home.Sherif Saoudi') }}</span>
                            </a>
                        </div>
                        <!-- /Logo Section -->

                        <!-- Welcome Text -->
                        <h4 class="mb-2">{{ __('home.Welcome to Sherif Saoudi Plateform') }} 👋</h4>
                        <!-- /Welcome Text -->

                        <!-- Authentication Form -->
                        <form id="formAuthentication" class="mb-3" action="{{ route('admin.login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" required autofocus />
                                @error('email')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <a href="auth-forgot-password-basic.html">
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                @error('password')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>
                        <!-- /Authentication Form -->
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>



    <!-- Core JS -->
    <script src="asset/vendor/libs/jquery/jquery.js"></script>
    <script src="asset/vendor/libs/popper/popper.js"></script>
    <script src="asset/vendor/js/bootstrap.js"></script>
    <script src="asset/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="asset/vendor/js/menu.js"></script>
    <script src="asset/js/main.js"></script>

    <!-- Page JS -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
