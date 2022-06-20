<?php

$auth = '';


if (isset($_SESSION["auth"]) && isset($_SESSION["userId"])) {
    $auth = $_SESSION["auth"];
}

if ($auth != "loggedin") {
    header("location: login.php");
}
