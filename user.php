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
$user = query("SELECT * FROM user");

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
                <a class="add-btn" href="add_user.php">Add User</a>
                <table class="table-data">
                    <thead>
                        <th scope="col">id</th>
                        <th scope="col">image</th>
                        <th scope="col">username</th>
                        <th scope="col">password</th>
                        <th scope="col">email</th>
                        <th scope="col">gender</th>
                        <th scope="col">birthdate</th>
                        <th scope="col">address</th>
                        <th scope="col">phnumber</th>
                        <th scope="col">role</th>
                        <th scope="col">options</th>
                    </thead>
                    <?php
                    foreach ($user as $row): ?>
                        <tr class="data-tr" >
                            <td class="data-td">
                                <?= $row["id_user"] ?>
                            </td>
                            <td class="data-td"><img class="img-data" src="assets/img/<?= $row["img"] ?>" alt=""></td>
                            <td class="data-td">
                                <?= $row["username"] ?>
                            </td>
                            <td class="data-td">
                                <?= str_repeat('•', min(12, strlen($row["password"]))) ?>
                            </td>
                            <td class="data-td">
                                <?= $row["email"]; ?>
                            </td>
                            <td class="data-td">
                                <?= $row["gender"] ?>
                            </td>
                            <td class="data-td">
                                <?= $row["birthdate"] ?>
                            </td>
                            <td class="data-td">
                                <?= $row["address"] ?>
                            </td>
                            <td class="data-td">
                                <?= $row["phnumber"] ?>
                            </td>
                            <td class="data-td">
                                <?= $row["role"] ?>
                            </td>
                            <td class="data-td">
                                <a class="update-btn" href="update_user.php?id=<?= $row["id_user"] ?>">UPDATE</a>
                                <a class="delete-btn" href="delete_user.php?id=<?= $row["id_user"] ?>"
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