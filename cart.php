<?php
session_start();
require("functions.php");
$userId = $_SESSION["userid"];
$cartItems = query("SELECT * FROM cart WHERE id_user = $userId");
include("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Cart</title>
</head>

<body>
    <div class="main-container">
        <main class="content">
            <div class="data-container">
                <table class="table-data">
                    <thead>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Remove</th>
                    </thead>
                    <?php foreach ($cartItems as $items): ?>
                        <tr>
                            <td class="data-td">
                                <?= getProductTitle($items["id_product"]); ?>
                            </td>
                            <td class="data-td">
                                <?= $items["qty"]; ?>
                            </td>
                            <td class="data-td">Rp.
                                <?= $items["price"]; ?>
                            </td>
                            <td class="data-td">
                                <a class="delete-btn flex-column" href="delete_cart.php?id=<?= $items["id_cart"] ?>">X</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            </div>
        </main>
        <?php include 'aside.php'; ?>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>