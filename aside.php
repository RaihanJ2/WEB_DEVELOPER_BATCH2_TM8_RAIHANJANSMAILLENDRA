<aside id="aside">
    <div class="flex-column">
        <a href="profile.php">Profile</a>
        <?php
        $role = $_SESSION["role"];
        if ($role === "admin") {
            echo '<a href="user.php">User List</a>';
            echo '<a href="category.php">Category</a>';
            echo '<a href="product.php">Product</a>';
        } else {
        }

        ?>
        <a href="cart.php">Cart</a>
        <a href="logout.php">Logout</a>
    </div>
</aside>