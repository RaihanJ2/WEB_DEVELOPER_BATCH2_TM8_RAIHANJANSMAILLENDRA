<?php

require 'functions.php';

$id = $_GET["id"];

if (deleteCategory($id) > 0) {
    echo "<script>alert('Category has been Remove!!');
    window.location.href = 'category.php';
    </script>";
} else {
    echo "<script>alert('Category failed to Remove!!');
        window.location.href = 'category.php';
        </script>";
}

?>