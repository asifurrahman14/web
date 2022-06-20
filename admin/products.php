<?php
include("./header.php");
include("./auth.php");
?>

<?php

// delete product

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    if ($action == "delete") {
        $deleteSql = "DELETE FROM products WHERE id=$id";
        $runDeleteUser = mysqli_query($db, $deleteSql);
        if ($runDeleteUser) {
            header('location: products.php');
        }
    }
}



// get all the products

$sql = "SELECT * FROM products ORDER BY id DESC";
$runSelectQ = mysqli_query($db, $sql);
$allProducts = [];
if (mysqli_num_rows($runSelectQ)  > 0) {
    while ($row = mysqli_fetch_assoc($runSelectQ)) {
        array_push($allProducts, $row);
    }
}

// get user with id

function getUser($id)
{
    $sql = "SELECT name FROM users WHERE id=$id";
    $runSelectQ = mysqli_query($GLOBALS['db'], $sql);
    $name = "";
    if (mysqli_num_rows($runSelectQ)  > 0) {
        while ($row = mysqli_fetch_assoc($runSelectQ)) {
            $name = $row['name'];
        }
    }
    return $name;
}


?>



<!-- page -->

<!-- container -->
<section>
    <div class="container">
        <div class="pageTtlwrp">
            <h2 class="pageTitle">All Products</h2>
            <a href="addProduct.php" class="btn">
                Add Products <img src="../img/add.png" alt="">
            </a>
        </div>
        <div class="row">

            <?php

            foreach ($allProducts as $key => $product) {

            ?>


                <div class="col prdtCrd">
                    <div class="option">
                        <div class="toggle"><img src="../img/more.png" alt=""></div>
                        <div class="dropDown">
                            <a href="./updateProduct.php?id=<?php echo $product['id']; ?>">Update <img src="../img/updating.png" alt=""></a>
                            <a href="?action=delete&id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure to delete?')">Delete <img src="../img/delete.png" alt=""></a>
                        </div>
                    </div>
                    <div class="hdr">
                        <img class="PrdtImg" src="../uploads/<?php echo $product['image']; ?>" alt="">
                    </div>
                    <div class="content">
                        <div class="prdtHdr">
                            <h3 class="prdtTTl">
                                <?php echo $product['name']; ?>
                            </h3>
                            <p class="pprice">BDT <?php echo number_format($product['price']); ?></p>
                        </div>
                        <div class="userMeta">
                            <img src="../img/user.png" alt="">
                            <?php echo getUser($product['user']); ?>
                        </div>
                    </div>

                </div>
            <?php } ?>

        </div>
    </div>
</section>
<?php
include("./footer.php");
?>