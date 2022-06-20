<?php
include("./header.php");
include("./auth.php");



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['userId'];

    $orderQuery = "INSERT INTO orders (user_id, product_id) VALUES ('$user_id', '$id')";
    $inserted = mysqli_query($db, $orderQuery);
    if ($inserted) {
        echo "<h2 style='margin-top:30px;text-align:center'>Order Submitted!</h2>";
    } else {
        header("location: index.php");
    }
}

include("./footer.php");
