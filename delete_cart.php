<?php

require 'functions.php';

$id = $_GET["id"];

if (deleteCart($id) > 0) {
    echo "<script>alert('Product has been Remove!!');
    window.location.href = 'cart.php';
    </script>";
} else {
    echo "<script>alert('Product failed to Remove!!');
        window.location.href = 'cart.php';
        </script>";
}

?>