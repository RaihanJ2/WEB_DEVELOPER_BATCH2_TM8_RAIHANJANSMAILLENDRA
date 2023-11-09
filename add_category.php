<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
if (isset($_POST['add'])) {
    
    if(addCategory($_POST) > 0) {
        echo "<script>alert('Category has been added!!');
    window.location.href = 'category.php';
    </script>";
    exit();
    }else {
        echo mysqli_error($db);
    }
}
    
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
    <title>Add Category</title>
</head>

<body>
<form action="" class="form flex-column" method="post" enctype="multipart/form-data">
      <div class="main flex-column">
        <h1>ADD</h1>
        <input class="textbox" required name="name_category" type="text" placeholder="Category" />
        <button class="submit" type="submit" name="add">Add</button>
      </div>
    </form>
</body>

</html>