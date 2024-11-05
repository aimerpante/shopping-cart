<?php
include 'function-for-cart.php'; 
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Array of items
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

// Calculate total item count in the cart
$cart_count = get_cart_count();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bag Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <header class="bg-black text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 m-0">Bag Collection</h1>
            <a href="cart.php" class="btn btn-outline-warning">
                <i class="bi bi-cart"></i> Cart 
                <span class="badge bg-warning text-dark"><?php echo $cart_count; ?></span>
            </a>
        </div>
    </header>

    <main class="container mt-4">
        <div class="row g-4">
            <?php foreach ($bags as $bag): ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card product-card bg-secondary text-white shadow-lg border-0 h-100">
                        <a href="details.php?id=<?php echo $bag['id']; ?>" class="text-decoration-none">
                            <div class="card-img-top position-relative overflow-hidden">
                                <img src="<?php echo $bag['image']; ?>" alt="<?php echo $bag['name']; ?>" class="img-fluid normal">
                                <img src="<?php echo $bag['image_hover']; ?>" alt="<?php echo $bag['name']; ?>" class="img-fluid hover position-absolute top-0 start-0 w-100 h-100">
                            </div>
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold"><?php echo $bag['name']; ?></h5>
                            <p class="card-text text-warning fs-5">₱<?php echo number_format($bag['price'], 2); ?></p>
                            <a href="details.php?id=<?php echo $bag['id']; ?>" class="btn btn-outline-warning mt-auto">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <style>
        .product-card {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .product-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);

        }

        .product-card img {
            transition: opacity 0.5s ease;
        }

        .product-card img.hover {
            opacity: 0;
        }

        .product-card:hover img.normal {
            opacity: 0;
        }

        .product-card:hover img.hover {
            opacity: 1;
        }

        .btn-outline-warning {
            border-color: #ffc107;
            color: #ffc107;
        }

        .btn-outline-warning:hover {
            background-color: #ffc107;
            color: #212529;
        }

        body {
            background-color: #1c1c1e;
        }

        .text-warning {
            color: #ffc107 !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
