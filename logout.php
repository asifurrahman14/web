<?php
session_start();
$_SESSION["auth"] = null;
$_SESSION["userId"] = null;
header("location: login.php");
