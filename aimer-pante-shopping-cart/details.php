<?php
include 'function-for-cart.php'; 

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

// Get item ID from URL
$item_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$item = null;

// Find item by ID
foreach ($bags as $product) {
    if ($product['id'] === $item_id) {
        $item = $product;
        break;
    }
}

// Redirect if item not found
if (!$item) {
    header("Location: index.php");
    exit;
}

// Calculate total item count in the cart
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        $cart_count += $cart_item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $item['name']; ?> - Bag Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<header class="bg-black text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="h4 m-0">Bag Shop Collection</h1>
        <a href="cart.php" class="btn btn-outline-warning">
            <i class="bi bi-cart"></i> Cart 
            <span class="badge bg-warning text-dark"><?php echo $cart_count; ?></span>
        </a>
    </div>
</header>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="product-image-wrapper">
                <div class="image-gallery border rounded shadow-sm overflow-hidden position-relative">
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="img-fluid main-image">
                    <img src="<?php echo $item['image_hover']; ?>" alt="<?php echo $item['name']; ?>" class="img-fluid hover-image position-absolute top-0 start-0">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="product-details p-4 border rounded bg-secondary">
                <h2 class="fw-bold"><?php echo $item['name']; ?></h2>
                <p class="text-warning fs-4">₱<?php echo number_format($item['price'], 2); ?></p>
                <p class="text-light mb-4"><?php echo $item['description']; ?></p>

                <form action="confirm.php" method="POST" class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                    <div class="mb-3">
                        <label for="size" class="form-label fw-bold">Select Size:</label>
                        <select name="size" id="size" class="form-select w-50">
                            <option value="Small">Small</option>
                            <option value="Medium">Medium</option>
                            <option value="Large">Large</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label fw-bold">Enter Quantity:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control w-50" value="1" min="1" max="99">
                    </div>

                    <button type="submit" class="btn btn-warning btn-lg w-100 mb-2"><i class="bi bi-check-circle"></i> Confirm Purchase</button>
                    <a href="index.php" class="btn btn-outline-light btn-lg w-100"><i class="bi bi-arrow-left"></i> Cancel / Go Back</a>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .product-image-wrapper {
        position: relative;
    }

    .image-gallery {
        border-radius: 10px;
    }

    .hover-image {
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .image-gallery:hover .hover-image {
        opacity: 1;
    }

    .image-gallery:hover .main-image {
        opacity: 0;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #e0a800;
    }

    .bg-secondary {
        background-color: #2a2a2a;
    }

    body {
        background-color: #1c1c1e;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
