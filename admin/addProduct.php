<?php
include("./header.php");
include("./auth.php");
?>


<?php

$sql = "SELECT * FROM users";
$runSelectQ = mysqli_query($db, $sql);
$allUsers = [];
if (mysqli_num_rows($runSelectQ)  > 0) {
    while ($row = mysqli_fetch_assoc($runSelectQ)) {
        array_push($allUsers, $row);
    }
}
?>


<?php

// add product
$status = "";
if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['user']) && isset($_FILES['image'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $user = mysqli_real_escape_string($db, $_POST['user']);
    $price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);


    $target_dir = "./uploads/";
    $imageName = rand(0, 9999999999) . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $imageName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {

        $uploadOk = 0;
    }

    if ($uploadOk) {
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $imageName = mysqli_real_escape_string($db, $imageName);
        $sql  = "INSERT INTO products (name, price, user, image) VALUES ('$name', '$price', '$user', '$imageName')";
        $queryRun = mysqli_query($db, $sql);
        if ($queryRun) {
            $status = "New product added successfully! ";
        }
    }
}


?>

<!-- page -->

<div class="formWrp">
    <div class="container">
        <div class="form">
            <h3 class="formTitle">
                Add a New Product
            </h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <input required type="text" name="name" placeholder="Name">
                <input required type="text" name="price" placeholder="Price">

                <select required name="user" id="">
                    <option selected value="" disabled>Select User</option>
                    <?php
                    foreach ($allUsers as $key => $user) {
                    ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>


                    <?php } ?>
                </select>
                <input required type="file" accept="image/png, image/gif, image/jpeg, image/jpg" name="image" placeholder="Icon">
                <button class="btn">Add Product <img src="../img/add.png" alt=""></button>
            </form>

            <?php
            if (strlen($status) > 0) {
                echo "<script>
                    window.location.href = 'products.php'
                    </script>";
            }
            ?>
        </div>
    </div>
</div>
<?php
include("./footer.php");
?>