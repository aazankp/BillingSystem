<?php
include "connection.php";
$acc_type = $_POST['acc_type'];
$query = mysqli_query($conn,"SELECT * FROM add_account WHERE account_type='$acc_type'");
echo "<option value=''>Select Account Name</option>";
while ($row = mysqli_fetch_assoc($query)) {
    # code...
    $acc_id = $row['id'];
    $acc_name = $row['account_name'];
    $opn_bal = $row['opening_balance'];
    echo "<option value='$acc_id' data-id='$opn_bal'>$acc_name</option>";
}
?>