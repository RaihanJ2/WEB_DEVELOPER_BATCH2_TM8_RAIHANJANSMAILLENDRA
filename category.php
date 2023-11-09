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
                <a class="add-btn" href="add_category.php">Add Category</a>
                <table class="table-data">
                    <thead>
                        <th scope="col">id</th>
                        <th scope="col">category</th>
                        <th scope="col">options</th>
                    </thead>
                    <?php
                    foreach ($category as $row): ?>
                        <tr class="data-tr" >
                            <td class="data-td">
                                <?= $row["id_category"] ?>
                            </td>
                            <td class="data-td">
                                <?= $row["name_category"] ?>
                            </td>
                            <td class="data-td">
                                <a class="delete-btn" href="delete_category.php?id=<?= $row["id_category"] ?>"
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