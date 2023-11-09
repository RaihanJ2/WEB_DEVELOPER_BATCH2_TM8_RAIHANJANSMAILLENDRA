<?php
require 'functions.php';

if (isset($_POST["register"])) {

  if (regis($_POST) > 0) {
    echo "<script>alert('Registration completed!!');
    window.location.href = 'login.php';
    </script>";
    exit();
  }else{
    echo mysqli_error($db);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/style.css">
  <title>REGISTER</title>
  <style>
    main{
      margin-top: 0!important;
    }
  </style>
</head>

<body>
  <main>
    <form action="" class="form flex-column" method="post" enctype="multipart/form-data">
      <div class="main flex-column">
        <h1>REGISTER</h1>
        <input class="textbox" required name="username" type="text" placeholder="Username" />
        <input class="textbox" required name="password" type="password" placeholder="Password" />
        <input class="textbox" required name="password2" type="password" placeholder="Confirm Password" />
        <input class="textbox" required name="email" type="email" placeholder="E-mail" min="12" />
        <div class="radio-btn">
          <div>
            <input required name="gender" type="radio" value="male" /> <label for="male">male</label>
          </div>
          <div>
            <input required name="gender" type="radio" value="female" /> <label for="female">female</label>
          </div>
        </div>

        <input class="textbox" required name="birthdate" type="Date" placeholder="BirthDate" />
        <input class="textbox" required name="address" type="text" placeholder="Address" />
        <input class="textbox" required name="phnumber" type="number" inputmode="numeric" placeholder="Phone Number" />
        <input class="textbox" required name="image" type="file" placeholder="Image" />
        <input type="hidden" value="user" name="role" />
        <a href="login.php">already have an account?</a>
        <button class="submit" type="submit" name="register">REGISTER</button>
      </div>
    </form>
  </main>
</body>

</html>