<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
if (isset($_POST['add'])) {
    
    if(add($_POST) > 0) {
        echo "<script>alert('Product has been added!!');
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Add Product</title>
</head>

<body>
<form action="" class="form flex-column" method="post" enctype="multipart/form-data">
      <div class="main flex-column">
        <h1>ADD</h1>
        <input class="textbox" required name="title" type="text" placeholder="Title" />
        <select id="category" name="id_category">
        <option value="" disabled selected>Category</option>
        <?php foreach ($category as $row): ?>
        <option value="<?= $row["id_category"]; ?>"><?= $row["name_category"]; ?></option>
        <?php endforeach; ?>
        <input class="textbox" required name="author" type="text" placeholder="Author" />
        <input class="textbox" required name="price" type="number" inputmode="numeric" placeholder="Prices" />
        <input class="textbox" required name="stock" type="number" inputmode="numeric" placeholder="Stocks" />
        <input class="textbox" required name="image" type="file" placeholder="Image" />
        
        <button class="submit" type="submit" name="add">Add</button>
      </div>
    </form>
</body>

</html>