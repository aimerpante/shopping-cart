<?php
include 'function-for-cart.php'; 

$bags = [
    [
        "id" => 1,
        "name" => "Pink Classic Handbag",
        "price" => 1200,
        "image" => "../imgs/B1a.jpg",
        "image_hover" => "../imgs/B1b.jpg"
    ],
    [
        "id" => 2,
        "name" => "Blue Elegant Handbag",
        "price" => 1250,
        "image" => "../imgs/B2a.jpg",
        "image_hover" => "../imgs/B2b.jpg"
    ],
    [
        "id" => 3,
        "name" => "Red Bag Satchel",
        "price" => 1350,
        "image" => "../imgs/B3a.jpg",
        "image_hover" => "../imgs/B3b.jpg"
    ],
    [
        "id" => 4,
        "name" => "Gray Backpack",
        "price" => 1400,
        "image" => "../imgs/B4b.jpg",
        "image_hover" => "../imgs/B4a.jpg"
    ],
    [
        "id" => 5,
        "name" => "Green Backpack",
        "price" => 1450,
        "image" => "../imgs/B5a.jpg",
        "image_hover" => "../imgs/B5b.jpg"
    ],
    [
        "id" => 6,
        "name" => "Blue Backpack",
        "price" => 1500,
        "image" => "../imgs/B6a.jpg",
        "image_hover" => "../imgs/B6b.jpg"
    ],
    [
        "id" => 7,
        "name" => "White Backpack",
        "price" => 1550,
        "image" => "../imgs/B7a.jpg",
        "image_hover" => "../imgs/B7b.jpg"
    ],
    [
        "id" => 8,
        "name" => "Black Backpack",
        "price" => 1600,
        "image" => "../imgs/B8a.jpg",
        "image_hover" => "../imgs/B8b.jpg"
    ]
];

// Process form submission for quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $id => $quantity) {
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $id) {
                $cart_item['quantity'] = max(1, min(99, (int)$quantity)); // Ensure quantity is between 1 and 99
            }
        }
    }
    header("Location: cart.php");
    exit;
}

// Calculate total cart value and item count
$total_price = 0;
$total_quantity = 0;

foreach ($_SESSION['cart'] as $cart_item) {
    foreach ($bags as $bag) {
        if ($bag['id'] === $cart_item['id']) {
            $total_price += $cart_item['quantity'] * $bag['price'];
            break;
        }
    }
    $total_quantity += $cart_item['quantity'];
}

$cart_count = $total_quantity;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Bag Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <header class="bg-black text-white py-3 shadow-sm mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Bag Shop Collection</h1>
            <a href="cart.php" class="btn btn-outline-warning position-relative">
                Cart
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                    <?php echo $cart_count; ?>
                </span>
            </a>
        </div>
    </header>

    <div class="container">
        <h2 class="mb-4">Your Shopping Cart</h2>

        <?php if (empty($_SESSION['cart'])): ?>
            <div class="alert alert-info text-center" role="alert">
                Your cart is currently empty.
            </div>
            <div class="text-center">
                <a href="index.php" class="btn btn-outline-warning btn-lg mt-3">Continue Shopping</a>
            </div>
        <?php else: ?>
            <form action="cart.php" method="POST">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-white">
                        <thead class="table-dark">
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $cart_item): ?>
                                <?php
                                    $item_details = null;
                                    foreach ($bags as $bag) {
                                        if ($bag['id'] === $cart_item['id']) {
                                            $item_details = $bag;
                                            break;
                                        }
                                    }
                                    if ($item_details):
                                        $item_total = $item_details['price'] * $cart_item['quantity'];
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?php echo $item_details['image']; ?>" alt="<?php echo htmlspecialchars($item_details['name']); ?>" class="me-3 rounded" style="width: 60px; height: auto;">
                                            <div>
                                                <strong><?php echo htmlspecialchars($item_details['name']); ?></strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><?php echo isset($cart_item['size']) ? htmlspecialchars($cart_item['size']) : 'N/A'; ?></td>
                                    <td class="text-center">
                                        <input type="number" name="quantity[<?php echo $cart_item['id']; ?>]" value="<?php echo $cart_item['quantity']; ?>" min="1" max="99" class="form-control w-50 mx-auto bg-secondary text-white border-0">
                                    </td>
                                    <td>₱<?php echo number_format($item_details['price'], 2); ?></td>
                                    <td>₱<?php echo number_format($item_total, 2); ?></td>
                                    <td class="text-center">
                                        <a href="remove.php?product_id=<?php echo $cart_item['id']; ?>" class="btn btn-outline-danger btn-sm">Remove</a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <tr class="table-light">
                                <td colspan="4" class="text-end fw-bold">Total</td>
                                <td colspan="2" class="fw-bold">₱<?php echo number_format($total_price, 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center gap-2 mt-4">
                    <a href="index.php" class="btn btn-outline-warning">Continue Shopping</a>
                    <button type="submit" class="btn btn-warning">Update Cart</button>
                    <a href="success.php" class="btn btn-warning">Proceed to Checkout</a>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <style>
        body {
            background-color: #1c1c1e;
        }

        .table {
            border-color: #343a40;
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

        .btn-outline-warning {
            border-color: #ffc107;
            color: #ffc107;
        }

        .btn-outline-warning:hover {
            background-color: #ffc107;
            color: #212529;
        }

        .table-dark th {
            color: #ffc107;
        }

        .form-control {
            color: #ffffff;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
