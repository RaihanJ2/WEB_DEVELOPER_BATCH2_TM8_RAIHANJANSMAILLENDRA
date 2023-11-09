<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET["id"];

$data = query("SELECT * FROM user WHERE id_user = $id")[0];

if (isset($_POST['update'])) {

    if (updateUser($_POST) > 0) {
        echo "<script>alert('user has been updated!!');
    window.location.href = 'user.php';
    </script>";
        exit();
    } else {
        echo mysqli_error($db);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Update Product</title>
</head>

<body>
    <form action="" class="form flex-column" method="post" enctype="multipart/form-data">
        <div class="main flex-column">
            <h1>Update</h1>
            <input type="hidden" name="id_user" value="<?= $data["id_user"]; ?>">
            <input type="hidden" name="oldImg" value="<?= $data["img"]; ?>">
            <input class="textbox" value="<?= $data["username"]; ?>" required name="username" type="text" />
            <input class="textbox" placeholder="Password" required name="password" type="password" />
            <input class="textbox" placeholder="Confirm Password" required name="password2" type="password" />
            <input class="textbox" value="<?= $data["email"]; ?>" required name="email" type="email" />
            <div class="radio-btn">
                <div>
                    <input required name="gender" type="radio" value="male" /> <label for="male">male</label>
                </div>
                <div>
                    <input required name="gender" type="radio" value="female" /> <label for="female">female</label>
                </div>
            </div>
            <input class="textbox" value="<?= $data["birthdate"]; ?>" required name="birthdate" type="text" />
            <input class="textbox" value="<?= $data["address"]; ?>" required name="address" type="text" />
            <input class="textbox" value="<?= $data["phnumber"]; ?>" required name="phnumber" type="number"
                inputmode="numeric" />
            <div class="radio-btn">
                <div>
                    <input required name="role" type="radio" value="user" /> <label for="user">user</label>
                </div>
                <div>
                    <input required name="role" type="radio" value="admin" /> <label for="admin">admin</label>
                </div>
            </div>
            <input class="textbox" value="assets/img/<?= $data["img"]; ?>" required name="image" type="file" />

            <button class="submit" type="submit" name="update">Update</button>
        </div>
    </form>
</body>

</html>