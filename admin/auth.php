<?php

$auth = '';
$role = null;

if (isset($_SESSION["auth"]) && isset($_SESSION["userId"])) {
    $auth = $_SESSION["auth"];
    $authId = $_SESSION["userId"];
    try {
        $selectUserWith = "SELECT role FROM users WHERE id='$authId'";
        $result = mysqli_query($db, $selectUserWith);
        while ($row = mysqli_fetch_assoc($result)) {
            $role = $row['role'];
        }
    } catch (\Throwable $th) {
        header("location: login.php");
    }
}

if ($auth != "loggedin" || $role != "admin") {
    echo $role;
    header("location: login.php");
}
