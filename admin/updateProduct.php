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


// grt all products

$product = [];

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $selectUserId = "SELECT * FROM products WHERE id=$id";
    $userResult = mysqli_query($db, $selectUserId);
    while ($row = mysqli_fetch_assoc($userResult)) {
        $product = $row;
    }
} else {
    header("location: products.php");
}



// update product
$status = "";
if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['user'])  && isset($_POST['productId'])) {

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $user = mysqli_real_escape_string($db, $_POST['user']);
    $price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);
    $productId = mysqli_real_escape_string($db, $_POST['productId']);


    if (isset($_FILES['image']) && $_FILES["image"]["name"]) {

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
            unlink("./uploads/" . $product['image']);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $imageName = mysqli_real_escape_string($db, $imageName);
            $sql  = "UPDATE products SET name='$name', price='$price', user='$user', image='$imageName' WHERE id=$productId";
            $queryRun = mysqli_query($db, $sql);
            if ($queryRun) {
                $status = "New product added successfully! ";
            }
        }
    } else {
        $sql  = "UPDATE products SET name='$name', price='$price', user='$user' WHERE id=$productId";
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
                You Are Editing Product: <?php echo $product['name']; ?>
            </h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
                <input value="<?php echo $product['name']; ?>" required type="text" name="name" placeholder="Name">
                <input value="<?php echo number_format($product['price']); ?>" required type="text" name="price" placeholder="Price">

                <select required name="user" id="">
                    <option selected value="" disabled>Select User</option>
                    <?php
                    foreach ($allUsers as $key => $user) {
                    ?>
                        <option <?php if ($product['user'] == $user['id']) {
                                    echo "selected";
                                } ?> value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>


                    <?php } ?>
                </select>
                <img style="width: 100px;height:100px;object-fit:cover" src="./uploads/<?php echo $product['image']; ?>" alt="">
                <input type="file" accept="image/png, image/gif, image/jpeg, image/jpg" name="image" placeholder="Icon">
                <button class="btn">Update Product <img src="../img/add.png" alt=""></button>
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