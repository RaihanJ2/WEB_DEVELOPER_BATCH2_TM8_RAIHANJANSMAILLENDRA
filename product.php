<?php
session_start();
require("functions.php");

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}
$userid = $_SESSION["userid"];
$role = $_SESSION["role"];
if ($role !== 'admin') {
    header('Location: index.php');
    exit();
}
$category = query("SELECT * FROM category");
$items = query("SELECT * FROM product");

include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="main-container">
        <main class="content">
            <div class="data-container flex-column">
                <a class="add-btn" href="add.php">Add Item</a>
                <table class="table-data">
                    <thead>
                        <th>no</th>
                        <th scope="col">id</th>
                        <th scope="col">image</th>
                        <th scope="col">title</th>
                        <th scope="col">author</th>
                        <th scope="col">category</th>
                        <th scope="col">price</th>
                        <th scope="col">stock</th>
                        <th scope="col">options</th>
                    </thead>
                    <?php
                    $i = 1;
                    foreach ($items as $row): ?>
                        <tr class="data-tr">
                            <td class="data-td">
                                <?= $i++; ?>
                            </td>
                            <td class="data-td">
                                <?= $row["id_product"] ?>
                            </td>
                            <td class="data-td"><img class="img-data" src="assets/img/<?= $row["img"] ?>" alt=""></td>
                            <td class="data-td">
                                <?= $row["title"] ?>
                            </td>
                            <td class="data-td">
                                <?= $row["author"] ?>
                            </td>
                            <td class="data-td">
                                <?= getCategoryName($row["id_category"]); ?>
                            </td>
                            <td class="data-td">
                                <?= $row["price"] ?>
                            </td>
                            <td class="data-td">
                                <?= $row["stock"] ?>
                            </td>
                            <td class="data-td">
                                <a class="update-btn" href="update.php?id=<?= $row["id_product"] ?>">UPDATE</a>
                                <a class="delete-btn" href="delete.php?id=<?= $row["id_product"] ?>"
                                    onclick="return confirm('are you sure?');">DELETE</a>
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