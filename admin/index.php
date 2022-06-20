<?php
include("./header.php");
include("./auth.php");
?>


<?php
$users = '';

$userNum = "SELECT id FROM users";
$result = mysqli_query($db, $userNum);
$users = mysqli_num_rows($result);




$products = '';
$productNum = "SELECT id FROM products";
$result = mysqli_query($db, $productNum);
$products = mysqli_num_rows($result);

$orders = '';
$orderNum = "SELECT id FROM orders";
$result = mysqli_query($db, $orderNum);
$orders = mysqli_num_rows($result)
?>
<!-- page -->

<!-- container -->
<section>
    <div class="container">
        <div class="pageTtlwrp" style="justify-content: center;">
            <h2 class="pageTitle">Welcome Back</h2>
            <a href="addCategories.html" class="btn">
                Add Category
                <img src="../img/add.png" alt="">
            </a>
        </div>

        <div class="row" style="justify-content: center;">
            <div class="col">

                <div class="hdr numbrHdr">
                    <?php echo $users; ?>
                </div>
                <div class="catTtl">
                    Total Users
                </div>
            </div>

            <div class="col">

                <div class="hdr numbrHdr">
                    <?php echo $products; ?>
                </div>
                <div class="catTtl">
                    Total Products
                </div>
            </div>

            <div class="col">

                <div class="hdr numbrHdr">
                    <?php echo $orders; ?>
                </div>
                <div class="catTtl">
                    Total Orders
                </div>
            </div>

        </div>
    </div>
</section>


<?php
include("./footer.php");
?>