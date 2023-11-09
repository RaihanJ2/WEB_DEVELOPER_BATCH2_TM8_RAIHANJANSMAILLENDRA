<?php 

require 'functions.php';

    $id = $_GET["id"];

    if (delete($id) > 0) {
        echo "<script>alert('Data has been Deleted!!');
    window.location.href = 'product.php';
    </script>";
    }else {
        echo "<script>alert('Data failed to Delete!!');
        window.location.href = 'product.php';
        </script>";
    }

?>