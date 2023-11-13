<?php
include "connection.php";
$acc_id = $_POST['acc_id'];
$query = mysqli_query($conn,"SELECT * FROM add_account WHERE id='$acc_id'");
while ($row = mysqli_fetch_assoc($query)) {
    # code...
    $acc_name = $row['account_name'];
    $account_id = $row['account_id'];
}
echo "<option value='$account_id'>$acc_name</option>";
?>