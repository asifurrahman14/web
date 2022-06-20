<?php
include("./header.php");


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
            <h2 class="pageTitle"> Products</h2>

        </div>
        <div class="row">

            <?php

            foreach ($allProducts as $key => $product) {

            ?>


                <div class="col prdtCrd">

                    <div class="hdr">
                        <img class="PrdtImg" src="./uploads/<?php echo $product['image']; ?>" alt="">
                    </div>
                    <div class="content">
                        <div class="prdtHdr">
                            <h3 class="prdtTTl">
                                <?php echo $product['name']; ?>
                            </h3>
                            <p class="pprice">BDT <?php echo number_format($product['price']); ?></p>
                        </div>
                        <div class="userMeta">
                            <a href="order.php?id=<?php echo $product['id'] ?>">Order Now</a>
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