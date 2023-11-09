<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}
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
$userid = $_SESSION["userid"];
$user = getUserById($userid); // You need to fetch the username

// You can create a function to get the username
function getUserById($userid)
{
    global $db;
    $result = mysqli_query($db, "SELECT * FROM user WHERE id_user = '$userid'");
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return 'Unknown'; // Return a default value or handle the case when the user is not found
    }
}
$borderColor = ($user["gender"] === "male") ? "#ffc60b" : "#f9989f";


include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>Registration Result</title>
    <style>
        .container {
            border-color:
                <?php echo $borderColor; ?>
                !important;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <main class="content">
            <div class="form flex-column">
                <div class="container">
                    <div class="user-img">
                        <img src="assets/img/<?= $user["img"]; ?>" alt="User" />
                    </div>
                    <div class="user-data flex-column">
                        <table>
                            <tr>
                                <td><label for="Username">Username </label></td>
                                <td>
                                    <?php echo $user["username"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="email">E-mail </label></td>
                                <td>
                                    <?php echo $user["email"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="Gender">Gender </label></td>
                                <td>
                                    <?php echo $user["gender"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="Birthdate">Birthdate </label></td>
                                <td>
                                    <?php echo $user["birthdate"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="Address">Address </label></td>
                                <td>
                                    <?php echo $user["address"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="phnumber">phnumber </label></td>
                                <td>
                                    <?php echo $user["phnumber"]; ?>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </main>
        <?php include 'aside.php'; ?>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>