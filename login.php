<?php
session_start();
require("functions.php");

if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit();
}

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'") or die(mysqli_error($db));

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {
      $_SESSION["login"] = true;
      $_SESSION["userid"] = $row['id_user'];
      $_SESSION["role"] = $row['role']; 
      setcookie('id', $row['id_user'], time() + 60);
      setcookie('key', hash('sha256', $row['username']), time() + 60);

      // Check role
      if ($row['role'] === 'admin') {
        header("Location: admin.php");
        exit();
      } else {
        header("Location: index.php");
        exit();
      }
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>LOGIN</title>
    <style>
    main{
      margin-top: 0!important;
    }
  </style>
</head>
<body>

    <main>
      <form action="" class="form flex-column" method="post">
        <div class="main flex-column">
          <h1 class="form-title">LOGIN</h1>
          <input class="textbox" name="username" type="" placeholder="Username" />
          <input class="textbox" name="password" type="password" placeholder="Password" />
          <a href="register.php">Register?</a>
          <button class="submit" type="submit" name="login">LOGIN</button>
        </div>
      </form>
    </main>
</body>
</html>