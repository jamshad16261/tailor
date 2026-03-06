<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Access Denied</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        .error-box {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
        }
        .error-box h1 {
            font-size: 100px;
            color: #dc3545;
        }
        .error-box p {
            font-size: 18px;
            color: #333;
        }
        .error-box a {
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
        }
        .error-box a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="error-container">
        <div class="error-box">
            <h1>403</h1>
            <p>Access Denied: You do not have permission to view this page.</p>
            <a href="<?php echo base_url('dashboard'); ?>">Go back to Dashboard</a>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
