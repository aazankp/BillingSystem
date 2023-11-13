<?php

session_start();
$uname=$_SESSION['username'];

if ($uname == "") {
  # code...
  header("location: login.php");
}

include "connection.php";
$get_id = $_GET['invoice_id'];


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Invoice</title>
  </head>
  <body>

<center>
  <h1><b>Invoice</b></h1>
  <h3><b>Hussainabad Hyderabad</b></h3>
  <h3><b>03118679523</b></h3> <br>
</center>

<?php

$query_name=mysqli_query($conn,"SELECT * FROM add_account WHERE id='$get_id'");
$row_name = mysqli_fetch_assoc($query_name);
$today_date = date("Y-m-d");

?>
                Date: <?php echo '<b>'.$today_date.'</b>'; ?> <br>
                Biller Name: <?php echo '<b>'.$row_name['account_name'].'</b>'; ?> <br>
                Customer: <b>Cash Customer</b> <br><br>

                <table border='1' align='center' cellspacing='0' cellpadding='5' width='100%' style="border:dotted;">
                    <tr align='center'>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>

            <?php

            $query_pro=mysqli_query($conn,"SELECT * FROM bill_detail WHERE bill_id='$get_id'");

            while ($row_pro = mysqli_fetch_assoc($query_pro)) {
                # code...
                $p_name = $row_pro['product_id'];
                $price = $row_pro['price'];
                $qty = $row_pro['quantity'];
                $total = $row_pro['total'];

            ?>

            <tr align='center'>
                    <td><?php echo $p_name; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $qty; ?></td>
                    <td><?php echo $total; ?></td>
                </tr>

            <?php
                }
            ?>

            </table>

            <br>

            <?php

            $query=mysqli_query($conn,"SELECT * FROM bill_detail WHERE bill_id='$get_id'");

            $count = mysqli_query($conn,"SELECT COUNT(product_id) as total_product FROM bill_detail WHERE bill_id='$get_id'");

            $count_row = mysqli_fetch_assoc($count);
            $tot_product = $count_row['total_product'];


            $count_qty = mysqli_query($conn,"SELECT sum(quantity) as qty FROM bill_detail WHERE bill_id='$get_id'");

            $count_row = mysqli_fetch_assoc($count_qty);
            $tot_qty = $count_row['qty'];
            $sum_total = mysqli_query($conn,"SELECT sum(total) as total FROM bill_detail WHERE bill_id='$get_id'");
            $tot_row = mysqli_fetch_assoc($sum_total);
            $total_amount = $tot_row['total'];

          

            // while ($row = mysqli_fetch_assoc($query)) {
            //     # code...
            //     $tot_amount = $row['total'];
            //     $price = $row['price'];
            //     $qty = $row['quantity'];

            // }

            ?>

            <table border='1' align='center' cellspacing='0' cellpadding='5' width='100%' style="border:none;">
                <tr>
                    <th align='left'>Total Amount</th>
                    <td align="right"><b> <?php echo $total_amount; ?> </b></td>
                </tr>
                <tr>
                    <th align='left'>Total Item & Quantity</th>
                    <td align="right"><b> <?php echo $tot_product; ?> (<?php echo $tot_qty; ?>) </b></td>
                </tr>
                <tr>
                    <th align='left'>Grand Total</th>
                    <td align="right"><b> <?php echo $total_amount; ?> </b></td>
                </tr>
            </table>
</body>
</html>