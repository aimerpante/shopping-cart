<?php
include 'function-for-cart.php'; 

$cart_count = get_cart_count();

$item_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : null;
$item = null;

if ($item_id && isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] == $item_id) {
            $item = $cart_item;
            break;
        }
    }
}

if (!$item) {
    header("Location: cart.php");
    exit;
}

// Bag collection array for item details
$bags = [
    [
        "id" => 1,
        "name" => "Pink Classic Handbag",
        "price" => 1200,
        "image" => "../imgs/B1a.jpg",
        "image_hover" => "../imgs/B1b.jpg",
        "description" => "A stylish pink classic handbag perfect for any occasion."
    ],
    [
        "id" => 2,
        "name" => "Blue Elegant Handbag",
        "price" => 1250,
        "image" => "../imgs/B2a.jpg",
        "image_hover" => "../imgs/B2b.jpg",
        "description" => "An elegant blue handbag that adds a touch of sophistication."
    ],
    [
        "id" => 3,
        "name" => "Red Bag Satchel",
        "price" => 1350,
        "image" => "../imgs/B3a.jpg",
        "image_hover" => "../imgs/B3b.jpg",
        "description" => "A bold red satchel that makes a statement."
    ],
    [
        "id" => 4,
        "name" => "Gray Backpack",
        "price" => 1400,
        "image" => "../imgs/B4b.jpg",
        "image_hover" => "../imgs/B4a.jpg",
        "description" => "A sleek and practical gray backpack for daily use."
    ],
    [
        "id" => 5,
        "name" => "Green Backpack",
        "price" => 1450,
        "image" => "../imgs/B5a.jpg",
        "image_hover" => "../imgs/B5b.jpg",
        "description" => "A green backpack with style and functionality."
    ],
    [
        "id" => 6,
        "name" => "Blue Backpack",
        "price" => 1500,
        "image" => "../imgs/B6a.jpg",
        "image_hover" => "../imgs/B6b.jpg",
        "description" => "A durable and stylish blue backpack."
    ],
    [
        "id" => 7,
        "name" => "White Backpack",
        "price" => 1550,
        "image" => "../imgs/B7a.jpg",
        "image_hover" => "../imgs/B7b.jpg",
        "description" => "A clean and versatile white backpack for any occasion."
    ],
    [
        "id" => 8,
        "name" => "Black Backpack",
        "price" => 1600,
        "image" => "../imgs/B8a.jpg",
        "image_hover" => "../imgs/B8b.jpg",
        "description" => "A modern and sleek black backpack for all your needs."
    ]
];

// Function to get item details
function getItemDetails($id, $items) {
    foreach ($items as $item) {
        if ($item['id'] == $id) {
            return $item;
        }
    }
    return null;
}

$product_details = getItemDetails($item_id, $bags);

if (!$product_details) {
    echo "<div class='alert alert-danger'>Product details not found. Please go back and try again.</div>";
    exit;
}

// Remove item from the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_SESSION['cart'] as $key => $cart_item) {
        if ($cart_item['id'] == $item_id) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            break;
        }
    }
    header("Location: cart.php?message=Item successfully removed.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Confirmation - Bag Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <!-- Header -->
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

    <div class="container mt-5">
        <div class="card bg-secondary text-white shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="position-relative">
                            <img src="<?php echo htmlspecialchars($product_details['image']); ?>" alt="<?php echo htmlspecialchars($product_details['name']); ?>" class="img-fluid rounded">
                            <img src="<?php echo htmlspecialchars($product_details['image_hover']); ?>" alt="<?php echo htmlspecialchars($product_details['name']); ?> (hover)" class="img-fluid rounded position-absolute top-0 start-0 w-100 h-100" style="opacity: 0; transition: opacity 0.5s;">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h3 class="fw-bold"><?php echo htmlspecialchars($product_details['name']); ?></h3>
                        <p class="text-warning fs-5">₱<?php echo number_format($product_details['price'], 2); ?></p>
                        <p><?php echo htmlspecialchars($product_details['description']); ?></p>
                        <p><strong>Size:</strong> <?php echo htmlspecialchars($item['size'] ?? 'N/A'); ?></p>
                        <p><strong>Quantity:</strong> <?php echo (int)$item['quantity']; ?></p>
                        <div class="d-flex justify-content-center mt-4 gap-2">
                            <form method="POST">
                                <button type="submit" class="btn btn-danger">Confirm Removal</button>
                            </form>
                            <a href="cart.php" class="btn btn-outline-warning">Cancel/Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-secondary {
            background-color: #2c2f33;
        }

        .btn-outline-warning {
            border-color: #ffc107;
            color: #ffc107;
        }

        .btn-outline-warning:hover {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
