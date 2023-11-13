<?php
include "connection.php";
$id = $_GET['id'];
include "fun.php";
$type = $_GET['type'];
$name_query = mysqli_query($conn,"SELECT * FROM add_account WHERE id='$id'");
$fetch_account = mysqli_fetch_assoc($name_query);
$name = $fetch_account['account_name'];
$account_type = $fetch_account['account_type'];

if ($from_date = $_GET['from_date'] & $to_date = $_GET['to_date']) {
  $posquery=mysqli_query($conn,"SELECT * FROM bill WHERE acc_id='$id' AND date>='$from_date' AND date<='$to_date'");
  $accountquery=mysqli_query($conn,"SELECT * FROM account_bill WHERE account_id='$id' AND date>='$from_date' AND date<='$to_date'");
  $trsquery=mysqli_query($conn,"SELECT * FROM  transaction WHERE account_id='$id' AND date>='$from_date' AND date<='$to_date'");
}else{
  $from_date="";
  $to_date="";
  $posquery=mysqli_query($conn,"SELECT * FROM bill WHERE acc_id='$id'");
  $accountquery=mysqli_query($conn,"SELECT * FROM account_bill WHERE account_id='$id'");
  $trsquery=mysqli_query($conn,"SELECT * FROM  transaction WHERE account_id='$id'");
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
                      <th colspan='5'><?php echo $name;?> Report (<?php echo $account_type;?>)</th>
                    </tr>
                  <tr align="center">
                    <th>S.No</th>
                    <th>Bill Type</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Date</th>
                  </tr>
                  </thead>

                  <tbody>
<?php
    $sno=1;
    while ($row=mysqli_fetch_assoc($posquery)){
      # code...
      $bill_id=$row['id'];
      $bill_type=$row['bill_type'];
      $acc_id=$row['acc_id'];
      $tot_amount=$row['total_amount'];
      $paid_amount=$row['paid_amount'];
      $date=$row['date'];
?>
    <tr align='center'>
        <td><?php echo $sno++; ?></td>
        <td><?php echo $bill_type; ?></td>
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
  <th rowspan='1' colspan='2' align='left'>Grand Total</th>
  <th rowspan="1" colspan="1"><?php echo get_pos_tot($id,$to_date,$from_date);?></th>
  <th rowspan='1' colspan='1'><?php echo get_pos_paid($id,$to_date,$from_date);?></th>
  <th rowspan="1" colspan="1"></th>
</tr>   
</tfoot>
                </table>
                <?php
    }elseif($type == 'account_bill'){ ?>
      <table align='center' border='1' cellspacing='0' cellpadding='5' width='70%'>
      <thead>
      <tr>
        <th colspan='5'><?php echo $name;?> Report (<?php echo $account_type;?>)</th>
      </tr>
                  <tr align="center">
                    <th>S.No</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Remaining Amount</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>

<?php

    $sno=1;

    while ($row=mysqli_fetch_assoc($accountquery)){
        # code...
    $acc_id=$row['account_id'];
    $tot_amount=$row['total_amount'];
    $paid_amount=$row['paid_amount'];
    $rem_amount = $row['remaining_amount'];
    $date=$row['date'];
    $img=$row['image'];
?>

    <tr align='center'>
        <td><?php echo $sno++; ?></td>
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
  <th rowspan='1' colspan='1' align='left'>Grand Total</th>
  <th rowspan='1' colspan='1'><?php echo get_acc_tot($id,$to_date,$from_date);?></th>
  <th rowspan="1" colspan="1"><?php echo get_acc_paid($id,$to_date,$from_date);?></th>
  <th rowspan="1" colspan="1"><?php echo get_acc_rem($id,$to_date,$from_date);?></th>
  <th rowspan='1' colspan='1'></th>
</tr>
</tfoot>
                </table>
    <?php
    }elseif($type == 'trs'){ ?>
      <table align='center' border='1' cellspacing='0' cellpadding='5' width='70%'>
      <thead>
      <tr>
        <th colspan='5'><?php echo $name;?> Report (<?php echo $account_type;?>)</th>
      </tr>
      <tr align="center">
                    <th>S.No</th>
                    <th>Transaction Type</th>
                    <th>Paid Amount</th>
                    <th>Description</th>
                    <th>Payment Type</th>
                  </tr>
                  </thead>
                  <tbody>

<?php

    $sno=1;
    while ($row=mysqli_fetch_assoc($trsquery)){
        # code...
    // $id = $row['id'];
    $trs_type=$row['transaction_type'];
    $acc_id=$row['account_id'];
    $paid_amount=$row['paid_amount'];
    $des = $row['description'];
    $pay_type=$row['payment_type'];   
?>

    <tr align='center'>
        <td><?php echo $sno++; ?></td>
        <td><?php echo $trs_type; ?></td>
        <td><?php echo $paid_amount; ?></td>
        <td><?php echo $des; ?></td>
        <td><?php echo $pay_type; ?></td>
    </tr>

<?php
    }
?>               
                  </tbody>
                  <tfoot>
<tr align='center'>
  <th rowspan='1' colspan='2' align='left'>Grand Total</th>
  <th rowspan="1" colspan="1"><?php echo get_trs_tot($id,$to_date,$from_date);?></th>
  <th rowspan="1" colspan="2"></th>
</tr>
</tfoot>
                </table>
    <?php
    }
    ?>
                  
</body>
</html>