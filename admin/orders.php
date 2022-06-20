<?php
include("./header.php");
include("./auth.php");
?>

<!-- /fetch users -->

<?php

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deleteSql = "DELETE FROM orders WHERE id=$id";
    $runDeleteUser = mysqli_query($db, $deleteSql);
    // if ($runDeleteUser) {
    //     header('location: products.php');
    // }
}


// get products

function getProduct($id)
{
    global $db;
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = mysqli_query($db, $sql);
    $prdt = null;
    while ($row = mysqli_fetch_assoc($result)) {
        $prdt = $row;
    }
    return $prdt;
}

function getUser($id)
{
    global $db;
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($db, $sql);
    $userinfo = null;
    while ($row = mysqli_fetch_assoc($result)) {
        $userinfo = $row;
    }
    return $userinfo;
}







// $userId = $_SESSION['userId'];
$sql = "SELECT * FROM orders  ORDER BY id DESC";
$runSelectQ = mysqli_query($db, $sql);
$allOrders = [];
if (mysqli_num_rows($runSelectQ)  > 0) {
    while ($row = mysqli_fetch_assoc($runSelectQ)) {
        array_push($allOrders, $row);
    }
}


?>

<!-- page -->
<div class="container">
    <div class="pageTtlwrp">
        <h2 class="pageTitle">All Orders</h2>
    </div>
</div>
<div class="tableWrp container">
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th> Price</th>
                <th>User</th>
                <th>Date</th>
                <th>Action</th>
            </tr>

        </thead>
        <tbody>


            <?php
            foreach ($allOrders as $key => $order) {
                $time  = strtotime($order['date']);
            ?>
                <tr>
                    <td style="text-align:left"><?php echo getProduct($order['product_id'])['name']; ?></td>

                    <td style="text-align:left">BDT <?php echo getProduct($order['product_id'])['price']; ?></td>
                    <td style="text-align:left"> <?php echo getUser($order['user_id'])['name']; ?></td>

                    <td style="text-align:left"><?php echo date("d-M-Y", $time); ?></td>

                    <td><a onclick="return confirm('Are you sure to delete?')" href="?delete=<?php echo $order['id']; ?>">Delete</a></td>
                </tr>

            <?php
            };

            ?>

        </tbody>
    </table>

</div>

<?php
include("./footer.php");
?>