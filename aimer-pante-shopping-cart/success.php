<?php
session_start();
session_destroy(); 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - Bag Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

    <header class="bg-black text-white py-3 shadow-sm mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Bag Shop Collection</h1>
            <a href="cart.php" class="btn btn-outline-warning position-relative">
                Cart
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">0</span>
            </a>
        </div>
    </header>

    <!-- Success Message -->
    <div class="container mt-5 text-center">
        <div class="p-5 rounded-3 shadow-sm bg-secondary text-white">
            <div class="icon mb-3">
                <div class="display-1 text-success fw-bold">&#10003;</div>
            </div>
            <h2 class="fw-bold mb-3">Order Successful!</h2>
            <p class="text-light">Thank you for shopping with us! Your order has been processed successfully.</p>
            <p>We hope to see you again soon!</p>
            <div class="mt-4">
                <a href="index.php" class="btn btn-warning">Continue Shopping</a>
            </div>
        </div>
    </div>

    <style>
        .bg-secondary {
            background-color: #2c2f33;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }

        .text-success {
            color: #28a745 !important;
        }

        .container .p-5 {
            background-color: #333;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
