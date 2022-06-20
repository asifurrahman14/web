<?php
include("./header.php");
include("./auth.php");
?>

<!-- /fetch users -->

<?php
// delete user

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    if ($action == "delete") {
        $deleteSql = "DELETE FROM users WHERE id=$id";
        $runDeleteUser = mysqli_query($db, $deleteSql);
        if ($runDeleteUser) {
            header('location: users.php');
        }
    }
}






$sql = "SELECT * FROM users  ORDER BY id DESC";
$runSelectQ = mysqli_query($db, $sql);
$allUsers = [];
if (mysqli_num_rows($runSelectQ)  > 0) {
    while ($row = mysqli_fetch_assoc($runSelectQ)) {
        array_push($allUsers, $row);
    }
}


?>

<!-- page -->
<div class="container">
    <div class="pageTtlwrp">
        <h2 class="pageTitle">All Users</h2>
        <a href="addUser.php" class="btn">
            Add User
            <img src="../img/add.png" alt="">
        </a>
    </div>
</div>
<div class="tableWrp container">
    <table>
        <thead>
            <tr>
                <th>Name</th>

                <th>
                    Role
                </th>

                <th>Email</th>

                <th>Phone</th>

                <th>Action </th>
            </tr>

        </thead>
        <tbody>


            <?php
            foreach ($allUsers as $key => $user) {

            ?>
                <tr>
                    <td><?php echo $user['name']; ?></td>

                    <td><?php echo $user['role']; ?></td>

                    <td><?php echo $user['email']; ?></td>

                    <td><?php echo $user['phone']; ?></td>

                    <td>
                        <div class="flex">
                            <a onclick="return confirm('Are you sure to delete?')" href="?action=delete&id=<?php echo $user['id']; ?>" title="Delete"><img src="../img/delete.png" alt=""></a>
                            <a href="updateUser.php?id=<?php echo $user['id']; ?>" ß title="Update"><img src="../img/updating.png" alt=""></a>
                        </div>
                    </td>
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