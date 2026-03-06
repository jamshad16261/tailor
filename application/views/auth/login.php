<!DOCTYPE html>
<html lang="en">

<head>
    <title>Asaan Biz | Login</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url('assets/images/favicon.svg') ?>" type="image/x-icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/fonts/tabler-icons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/fonts/fontawesome.css') ?>">

    <!-- Bootstrap & Theme CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">

    <style>
        body {
            font-family: 'Public Sans', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('<?php echo base_url("assets/images/login-bg.jpg"); ?>') no-repeat center center fixed;
            background-size: cover;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 40px 30px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .auth-card h3 {
            font-weight: 700;
        }

        .auth-card .form-control {
            position: relative;
            padding-left: 40px;
        }

        .auth-card .form-control-icon {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #888;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .text-muted a {
            color: #4e73df;
            text-decoration: none;
        }

        .text-muted a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="auth-card">

        <div class="text-center mb-4">
            <h3>Asaan Biz</h3>
            <p class="text-muted mb-0">Business Management System</p>
        </div>

        <form action="<?= base_url('Auth/login_action') ?>" method="post">

            <div class="mb-3 position-relative">
                <i class="ti ti-mail form-control-icon"></i>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required autofocus>
            </div>

            <div class="mb-3 position-relative">
                <i class="ti ti-lock form-control-icon"></i>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <!--<input class="form-check-input" type="checkbox" id="rememberMe" checked>-->
                    <!--<label class="form-check-label" for="rememberMe">Keep me signed in</label>-->
                </div>
                <!--<a href="#" class="text-primary">Forgot Password?</a>-->
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-lg">Login</button>
            </div>

            <div class="text-center">
                <p class="mb-0">
                    Don't have an account?
                    <a href="<?= base_url('Auth/register') ?>" class="link-primary">Register</a>
                </p>
            </div>

        </form>

        <div class="text-center mt-4">
            <small class="text-muted">© <?= date('Y') ?> Asaan Biz. All rights reserved.</small>
        </div>

    </div>

</body>

</html>
