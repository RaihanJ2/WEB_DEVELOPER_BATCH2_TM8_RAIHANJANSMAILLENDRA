<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET["id"];

    $data = query("SELECT * FROM product WHERE id_product = $id")[0];

if (isset($_POST['update'])) {
    
    if(update($_POST) > 0) {
        echo "<script>alert('Product has been updated!!');
    window.location.href = 'product.php';
    </script>";
    exit();
    }else {
        echo mysqli_error($db);
    }
}

$category = query("SELECT * FROM category");
    
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
        <input type="hidden" name="id_product" value="<?= $data["id_product"]; ?>">
        <input type="hidden" name="oldImg" value="<?= $data["img"]; ?>">
        <input class="textbox" value="<?= $data["title"]; ?>" required name="title" type="text" placeholder="Title" />
        <select id="category" name="id_category">
        <option value="" disabled selected>Category</option>
        <?php foreach ($category as $row): ?>
        <option value="<?= $row["id_category"]; ?>"><?= $row["name_category"]; ?></option>
        <?php endforeach; ?>
        </select>
        <input class="textbox" value="<?= $data["author"]; ?>" required name="author" type="text" placeholder="Author" />
        <input class="textbox" value="<?= $data["price"]; ?>" required name="price" type="number" inputmode="numeric" placeholder="Prices" />
        <input class="textbox" value="<?= $data["stock"]; ?>" required name="stock" type="number" inputmode="numeric" placeholder="Stocks" />
        <input class="textbox" value="assets/img/<?= $data["img"]; ?>" required name="image" type="file" placeholder="Image" />
        
        <button class="submit" type="submit" name="update">Update</button>
      </div>
    </form>
</body>
</html>