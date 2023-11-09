<?php

$db = mysqli_connect("localhost", "root", "", "db_marketplace");

function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $box = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $box[] = $row;
    }
    return $box;
}

// UPLOAD IMAGE
function upload()
{
    $fileName = $_FILES["image"]["name"];
    $fileTmp = $_FILES["image"]["tmp_name"];
    $extensionValid = ['jpg', 'jpeg', 'png'];
    $extensionImage = explode('.', $fileName);
    $extensionImage = strtolower(end($extensionImage));

    if (!in_array($extensionImage, $extensionValid)) {
        echo "
            <script>
                alert('wrong extension');
            </script>";
        return false;
    }

    $newName = uniqid();
    $newName .= '.';
    $newName .= $extensionImage;

    move_uploaded_file($fileTmp, 'assets/img/' . $newName);
    return $newName;
}
// REGISTER USER
function regis($data)
{
    global $db;

    $username = strtolower($data["username"]);
    $password = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);
    $email = $data["email"];
    $gender = $data["gender"];
    $birthdate = $data["birthdate"];
    $address = $data["address"];
    $phnumber = $data["phnumber"];
    $image = upload();
    $role = $data["role"];

    if (!$image) {
        return false;
    }



    // cek username sudah ada atau belum
    $result = mysqli_query($db, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
        return false;
    }

    //password validation
    if ($password !== $password2) {
        echo "<script>
            alert('Password not match!!');
            </script>";
        return false;
    }

    //password encryption
    $password = password_hash($password, PASSWORD_DEFAULT);

    //insert register value
    $result = mysqli_query($db, "INSERT INTO user VALUES('', '$username', '$password', '$email', '$gender', '$birthdate', '$address', '$phnumber', '$image', '$role')");
    //validate register

    return mysqli_affected_rows($db);
}
// ADD DATA

function addCategory($data)
{
    global $db;
    $category = $data["name_category"];

    $result = mysqli_query($db, "SELECT name_category FROM category WHERE name_category = '$category'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
				alert('Product already exist!')
		      </script>";
        return false;
    }
    $result = mysqli_query($db, "INSERT INTO category VALUES('','$category')");

    return mysqli_affected_rows($db);

}
function add($data)
{
    global $db;
    $category = $data["id_category"];
    $title = strtolower($data["title"]);
    $author = strtolower($data["author"]);
    $price = $data["price"];
    $stock = $data["stock"];
    $image = upload();

    if (!$image) {
        return false;
    }

    $result = mysqli_query($db, "SELECT title FROM product WHERE title = '$title'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
				alert('Product already exist!')
		      </script>";
        return false;
    }
    $result = mysqli_query($db, "INSERT INTO product VALUES('', '$category', '$image', '$title', '$author', '$price', '$stock')");

    return mysqli_affected_rows($db);
}
function delete($id)
{
    global $db;
    mysqli_query($db, "DELETE FROM product WHERE id_product = $id");
    return mysqli_affected_rows($db);
}
function deleteUser($id)
{
    global $db;
    mysqli_query($db, "DELETE FROM user WHERE id_user = $id");
    return mysqli_affected_rows($db);
}
function deleteCart($id)
{
    global $db;
    mysqli_query($db, "DELETE FROM cart WHERE id_cart = $id");
    return mysqli_affected_rows($db);
}
function deleteCategory($id)
{
    global $db;
    mysqli_query($db, "DELETE FROM category WHERE id_category = $id");
    return mysqli_affected_rows($db);
}
function update($data)
{
    global $db;
    $id = $data["id_product"];
    $category = $data["id_category"];
    $title = strtolower($data["title"]);
    $author = strtolower($data["author"]);
    $price = $data["price"];
    $stock = $data["stock"];
    $oldImg = htmlspecialchars($data["oldImg"]);

    if ($_FILES['image']['error'] === 4) {
        $image = $oldImg;
    } else {
        $image = upload();
    }
    $query = "UPDATE product SET 
    id_product = '$id',
    id_category = '$category',
    img = '$image',
     title = '$title',
      author = '$author',
       price = '$price',
        stock = '$stock'
         WHERE id_product = $id
         ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
function updateUser($data)
{
    global $db;
    $id = $data["id_user"];
    $username = strtolower($data["username"]);
    $password = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);
    $email = $data["email"];
    $gender = $data["gender"];
    $birthdate = $data["birthdate"];
    $address = $data["address"];
    $phnumber = $data["phnumber"];
    $image = upload();
    $role = $data["role"];
    $oldImg = htmlspecialchars($data["oldImg"]);


    if ($_FILES['image']['error'] === 4) {
        $image = $oldImg;
    } else {
        $image = upload();
    }
    if ($password !== $password2) {
        echo "<script>
            alert('Password not match!!');
            </script>";
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE user SET 
    id_user = '$id',
    username = '$username',
    password = '$password',
    email = '$email',
    gender = '$gender',
    birthdate = '$birthdate',
    address = '$address',
    phnumber = '$phnumber',
    img = '$image',
    role = '$role'
         WHERE id_user = $id
         ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
function search($keyword)
{
    $query = "SELECT * FROM product 
    WHERE 
    title LIKE '%$keyword%'";
    return query($query);
}

function getCategoryName($categoryId)
{
    global $db;
    $result = mysqli_query($db, "SELECT name_category FROM category WHERE id_category = '$categoryId'");
    $row = mysqli_fetch_assoc($result);
    return $row['name_category'];
}

if (isset($_POST["category_id"])) {
    $category_id = $_POST["category_id"];

    echo getProductsByCategory($category_id);
    exit;
}
function getProductTitle($productId)
{
    global $db;

    $productId = mysqli_real_escape_string($db, $productId);

    $query = "SELECT title FROM product WHERE id_product = '$productId'";
    $result = mysqli_query($db, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['title'];
    }

    return "Product Not Found";
}
function getProductsByCategory($category_id)
{
    global $db;

    $category_id = mysqli_real_escape_string($db, $category_id);

    $query = "SELECT * FROM product WHERE id_category = '$category_id'";
    $items = query($query);

    $product = '';
    foreach ($items as $row) {
        $product .= '
        <div class="card flex-column">
        <img src="assets/img/' . $row["img"] . '" alt="">
        <div class="card-body flex-column">
                    <div class="card-title">
                         ' . $row["title"] . ' </div>
        <div class="card-author">
            ' . $row["author"] . '
        </div>
        <div class="category-container">
            <div class="category">
                ' . getCategoryName($row["id_category"]) . '
            </div>
        </div>
        <form method="post" class="card-footer" action="">
            <input type="hidden" name="product_id" value=' . $row['id_product'] . '>
                <span class="card-prices">Rp.
                    ' . $row["price"] . ',-
                 </span>
                <span><input type="number" name="qty" id="qty" min="1"
                max="' . $row['stock'] . '"value="1"></span>
                <button class="card-button" name="cart" type="submit">Add To Cart</button>
        </form>
    </div>
    </div>
        ';
    }

    return $product;
}
if (isset($_POST["reset"])) {
    $items = query("SELECT * FROM product");
    $product = '';
    foreach ($items as $row) {
        $product .= '
        <div class="card flex-column">
        <img src="assets/img/' . $row["img"] . '" alt="">
        <div class="card-body flex-column">
                    <div class="card-title">
                         ' . $row["title"] . ' </div>
        <div class="card-author">
            ' . $row["author"] . '
        </div>
        <div class="category-container">
            <div class="category">
                ' . getCategoryName($row["id_category"]) . '
            </div>
        </div>
        <form method="post" class="card-footer" action="">
            <input type="hidden" name="product_id" value=' . $row['id_product'] . '>
                <span class="card-prices">Rp.
                    ' . $row["price"] . ',-
                 </span>
                <span><input type="number" name="qty" id="qty" min="1"
                max="' . $row['stock'] . '"value="1"></span>
                <button class="card-button" name="cart" type="submit">Add To Cart</button>
        </form>
    </div>
    </div>
        ';
    }
    echo $product;
    exit;
}

function addToCart($userId, $productId, $qty)
{
    global $db;

    $product = query("SELECT price, stock FROM product WHERE id_product = $productId");

    if (empty($product)) {
        return "Product not found";
    }

    $price = $product[0]["price"];
    $stock = $product[0]["stock"];

    if ($qty <= 0 || $qty > $stock) {
        return "Invalid quantity";
    }

    $total = $price * $qty;

    $result = mysqli_query($db,"INSERT INTO cart (id_user, id_product, qty, price, status) 
              VALUES ($userId, $productId, $qty, $total, 'process')");

    return $result;

}
?>