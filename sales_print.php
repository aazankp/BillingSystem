<?php
include "connection.php";
// include "fun.php";
$type = $_GET['type'];

if ($from_date = $_GET['from_date'] & $to_date = $_GET['to_date']) {
  $sale_posquery=mysqli_query($conn,"SELECT * FROM bill WHERE bill_type='customer' AND date>='$from_date' AND date<='$to_date'");
  $sale_accountquery=mysqli_query($conn,"SELECT * FROM account_bill WHERE bill_type='sell' AND date>='$from_date' AND date<='$to_date'");
}else{
  $from_date="";
  $to_date="";
  $sale_posquery=mysqli_query($conn,"SELECT * FROM bill WHERE bill_type='customer'");
  $sale_accountquery=mysqli_query($conn,"SELECT * FROM account_bill WHERE bill_type='sell'");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Print</title>
</head>
<body>
  <br>
  <br>
  <?php
    if ($type == 'pos') { ?>
      <table align='center' border='1' cellspacing='0' cellpadding='5' width='70%'>
      <thead>
                    <tr>
                      <th colspan='3'>From:(<?php echo $from_date;?>)</th>
                      <th colspan='3'>To:(<?php echo $to_date;?>)</th>
                    </tr>
                  <tr align="center">
                    <th>S.No</th>
                    <th>Bill Type</th>
                    <th>Name</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Date</th>
                  </tr>
                  </thead>

                  <tbody>
<?php
    $sno=1;
    while ($row=mysqli_fetch_assoc($sale_posquery)){
      # code...
      $bill_id=$row['id'];
      $bill_type=$row['bill_type'];
      $pos_acc_id=$row['acc_id'];
      $tot_amount=$row['total_amount'];
      $paid_amount=$row['paid_amount'];
      $date=$row['date'];

      $pos_name_query = mysqli_query($conn,"SELECT * FROM add_account WHERE id='$pos_acc_id'");
    while ($fetch_pos_name = mysqli_fetch_assoc($pos_name_query)) {
    # code...
      $pos_name = $fetch_pos_name['account_name'];
    }
?>
    <tr align='center'>
        <td><?php echo $sno++; ?></td>
        <td><?php echo $bill_type; ?></td>
        <td><?php echo $pos_name; ?></td>
        <td><?php echo $tot_amount; ?></td>
        <td><?php echo $paid_amount; ?></td>
        <td><?php echo $date; ?></td>
    </tr>
<?php
    }
?>               
                  </tbody>
                  <tfoot>
<tr align='center'>
  <th rowspan='1' colspan='3' align='left'>Grand Total</th>
  <th rowspan="1" colspan="1"></th>
  <th rowspan='1' colspan='1'></th>
  <th rowspan="1" colspan="1"></th>
</tr>   
</tfoot>
                </table>
                <?php
    }elseif($type == 'account_bill'){ ?>
      <table align='center' border='1' cellspacing='0' cellpadding='5' width='70%'>
      <thead>
      <tr>
      <tr>
        <th colspan='4'>From:(<?php echo $from_date;?>)</th>
        <th colspan='3'>To:(<?php echo $to_date;?>)</th>
      </tr>
                  <tr align="center">
                    <th>S.No</th>
                    <th>Bill Type</th>
                    <th>Name</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Remaining Amount</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>

<?php

    $sno=1;

    while ($row=mysqli_fetch_assoc($sale_accountquery)){
        # code...
    $acc_id=$row['account_id'];
    $bill_type_acc=$row['bill_type'];
    $tot_amount=$row['total_amount'];
    $paid_amount=$row['paid_amount'];
    $rem_amount = $row['remaining_amount'];
    $date=$row['date'];
    $img=$row['image'];

    $acc_name_query = mysqli_query($conn,"SELECT * FROM add_account WHERE id='$acc_id'");
    while ($fetch_acc_name = mysqli_fetch_assoc($acc_name_query)) {
    # code...
      $acc_name = $fetch_acc_name['account_name'];
    }
?>

    <tr align='center'>
        <td><?php echo $sno++; ?></td>
        <td><?php echo $bill_type_acc; ?></td>
        <td><?php echo $acc_name; ?></td>
        <td><?php echo $tot_amount; ?></td>
        <td><?php echo $paid_amount; ?></td>
        <td><?php echo $rem_amount; ?></td>
        <td><?php echo $date; ?></td>
    </tr>

<?php
    }
?>
                  </tbody>
                  <tfoot>
<tr align='center'>
  <th rowspan='1' colspan='3' align='left'>Grand Total</th>
  <th rowspan='1' colspan='1'></th>
  <th rowspan="1" colspan="1"></th>
  <th rowspan="1" colspan="1"></th>
  <th rowspan='1' colspan='1'></th>
</tr>
</tfoot>
                </table>
    <?php
    }
    ?>
                  
</body>
</html>