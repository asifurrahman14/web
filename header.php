<?php
session_start();
include("./admin/db.php");



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOCK SOFT </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- link google font cdn -->
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,200;0,600;0,700;0,800;0,900;1,300&display=swap" rel="stylesheet">

    <!-- link css -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- header -->
    <header>
        <nav>
            <div class="container">
                <div class="nav">
                    <a href="index.php" class="logo">
                        <img src="./img/logo.png" alt="">
                    </a>
                    <ul class="navItems">
                        <li><a href="index.php">Products</a></li>
                        <li><a href="orders.php">Orders</a></li>
                        <!-- <li><a href="users.php">Users</a></li> -->
                        <li>
                            <?php
                            $sauth = '';

                            if (isset($_SESSION["auth"]) && isset($_SESSION["userId"])) {
                                $sauth = $_SESSION["auth"];
                            }

                            if ($sauth == "loggedin") {
                                echo '<a href="logout.php" class="btn">Logout <img src="./img/logout.png" alt=""></a>';
                            } else {
                                echo '<a href="login.php" class="btn">Login <img src="./img/logout.png" alt=""></a>';
                            }


                            ?>

                        </li>
                        <!-- <li><a href="#"></a></li> -->
                    </ul>

                </div>
            </div>
        </nav>
    </header>