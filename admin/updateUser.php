<?php
include("./header.php");
include("./auth.php");
?>


<?php

// grt user data

$user = [];

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $selectUserId = "SELECT * FROM users WHERE id=$id";
    $userResult = mysqli_query($db, $selectUserId);
    while ($row = mysqli_fetch_assoc($userResult)) {
        $user = $row;
    }
} else {
    header("location: users.php");
}



// update users
$status = "";
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['role']) && isset($_POST['userId'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $id = mysqli_real_escape_string($db, $_POST['userId']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $role = mysqli_real_escape_string($db, $_POST['role']);

    $sql  = "UPDATE users  SET name='$name', email='$email', phone='$phone', role='$role'  WHERE id=$id";
    $queryRun = mysqli_query($db, $sql);
    if ($queryRun) {
        $status = "New User added successfully! ";
    }
}

// get user



?>









<!-- page -->

<div class="formWrp">
    <div class="container">
        <div class="form">
            <h3 class="formTitle">
                You Are Editing User: <?php echo $user['name']; ?>
            </h3>
            <form action="" method="POST">
                <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
                <input value="<?php echo $user['name']; ?>" name="name" required type="text" placeholder=" Name">
                <input value="<?php echo $user['email']; ?>" type="email" name="email" placeholder="Email" id="">
                <input value="<?php echo $user['phone']; ?>" type="tel" name="phone" placeholder="Phone" id="">
                <select required name="role" id="">
                    <option selected value="" disabled>Select Role</option>
                    <option <?php if ($user['role'] == 'admin') echo 'selected'; ?> value="admin">Admin</option>
                    <option <?php if ($user['role'] == 'user') echo 'selected'; ?> value="user">User</option>
                </select>

                <?php
                if (strlen($status) > 0) {
                    echo "<script>
                    window.location.href = 'users.php'
                    </script>";
                }
                ?>


                <button class="btn">Update User <img src="../img/add.png" alt=""></button>
            </form>
        </div>
    </div>
</div>
<?php
include("./footer.php");
?>