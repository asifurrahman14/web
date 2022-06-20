<?php
include("./header.php");

$auth = '';
if (isset($_SESSION["auth"]) && $_SESSION["userId"]) {
    $auth = $_SESSION["auth"];
}
if ($auth == "loggedin") {
    header("location: index.php");
}


?>

<!-- work with login -->
<?php
$error = null;
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);;
    $selectUserWith = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($db, $selectUserWith);
    $dbPwd = null;
    $userId = null;
    while ($row = mysqli_fetch_assoc($result)) {
        $dbPwd = $row['password'];
        $userId = $row['id'];
    }
    if ($dbPwd) {
        if (password_verify($password, $dbPwd)) {
            $auth = $_SESSION["auth"] = "loggedin";
            $_SESSION["userId"] = $userId;
            header('location: index.php');
        } else {
            $error = "Incorrect Password";
        }
    }
}




?>


<!-- page -->

<div class="formWrp">
    <div class="container">
        <div class="form">
            <h3 class="formTitle">
                Login User
            </h3>
            <form action="" method="POST">
                <input required type="email" name="email" placeholder="Email Address" id="">
                <input required type="password" name="password" placeholder="Password" id="">
                <?php
                if ($error) {
                    echo '<p style="color: red;font-size: 13px;font-weight: 600;text-align: left;">' . $error . '</p>';
                }

                ?>

                <button class="btn">Login <img src="../img/login.png" alt=""></button>
            </form>
        </div>
    </div>
</div>
<?php
include("./footer.php");
?>