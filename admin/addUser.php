<?php
include("./header.php");
include("./auth.php");
?>


<?php
// add users
$status = "";
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['role']) && isset($_POST['password'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $role = mysqli_real_escape_string($db, $_POST['role']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql  = "INSERT INTO users (name, email, phone, password, role) VALUES ('$name', '$email', '$phone', '$password', '$role')";
    $queryRun = mysqli_query($db, $sql);
    if ($queryRun) {
        $status = "New User added successfully! ";
    }
}


?>









<!-- page -->

<div class="formWrp">
    <div class="container">
        <div class="form">
            <h3 class="formTitle">
                Add a New User
            </h3>
            <form action="" method="POST">
                <input name="name" required type="text" placeholder=" Name">
                <input type="email" name="email" placeholder="Email" id="">
                <input type="tel" name="phone" placeholder="Phone" id="">
                <select required name="role" id="">
                    <option selected value="" disabled>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <input minlength="8" type="password" name="password" placeholder="Password" id="">
                <?php
                if (strlen($status) > 0) {
                    echo "<script>
                    window.location.href = 'users.php'
                    </script>";
                }
                ?>


                <button class="btn">Add User <img src="../img/add.png" alt=""></button>
            </form>
        </div>
    </div>
</div>
<?php
include("./footer.php");
?>