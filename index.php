<?php
session_start();
require("functions.php");

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}
$userId = $_SESSION["userid"];
$category = query("SELECT * FROM category");
$items = query("SELECT * FROM product");

if (isset($_POST["search"])) {
    $items = search($_POST["keyword"]);
}

if (isset($_POST["cart"])) {
    $userId = $_SESSION["userid"];
    $productId = $_POST["product_id"];
    $qty = (int)$_POST["qty"];

    $result = addToCart($userId, $productId, $qty);
}



include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Buux</title>
</head>

<body>
    <div class="main-container">
        <main class="content">
            <section class="banner">
                <div class="slider-wrapper">
                    <div class="slider">
                        <img id="slide-1" src="assets/img2/b1.png" alt="" />
                        <img id="slide-2" src="assets/img2/b2.png" alt="" />
                        <img id="slide-3" src="assets/img2/b3.png" alt="" />
                    </div>
                    <div class="slider-nav">
                        <a href="#slide-1"></a>
                        <a href="#slide-2"></a>
                        <a href="#slide-3"></a>
                    </div>
                </div>
            </section>
            <section id="shop" class="shop">
                <div class="shop-container">
                    <label for="category">Category</label>
                    <?php
                    foreach ($category as $row): ?>
                        <button class="cat-btn" data-category-id="<?= $row["id_category"]; ?>">
                            <?= $row["name_category"]; ?>
                        </button>
                    <?php endforeach; ?>
                    <div class="category-buttons">
                        <button id="reset" class="cat-btn">Reset</button>
                    </div>
                    <form class="search-bar" action="" method="post">
                        <input type="text" id="search" name="keyword" autocomplete="off"
                            placeholder="Search by name...">
                        <button type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div class="card-container">
                    <?php foreach ($items as $row): ?>
                        <div class="card flex-column">
                            <img src="assets/img/<?= $row["img"] ?>" alt="">
                            <div class="card-body flex-column">
                                <div class="card-title">
                                    <?= $row["title"] ?>
                                </div>
                                <div class="card-author">
                                    <?= $row["author"] ?>
                                </div>
                                <div class="category-container">
                                    <div class="category">
                                        <?= getCategoryName($row["id_category"]); ?>
                                    </div>
                                </div>
                                <form method="post" class="card-footer" action="">
                                    <input type="hidden" name="product_id" value="<?= $row['id_product']; ?>">
                                    <span class="card-prices">Rp.
                                        <?= $row["price"] ?>,-
                                    </span>
                                    <span><input type="number" name="qty" id="qty" min="1"
                                            max="<?= $row['stock']; ?>"value="1"></span>
                                    <button class="card-button" name="cart" type="submit">Add To
                                        Cart</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </main>
    <?php include 'aside.php'; ?>
       
    </div>
    <?php include 'footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>

</html>