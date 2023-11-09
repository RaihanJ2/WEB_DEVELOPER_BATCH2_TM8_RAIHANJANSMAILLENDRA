<?php 

require 'functions.php';

    $id = $_GET["id"];

    if (deleteUser($id) > 0) {
        echo "<script>alert('User has been Deleted!!');
    window.location.href = 'user.php';
    </script>";
    }else {
        echo "<script>alert('User failed to Delete!!');
        window.location.href = 'user.php';
        </script>";
    }

?>