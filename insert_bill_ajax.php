<?php

include "connection.php";

$bill = $_POST['bill'];
$date = $_POST['date'];
$cust_name = $_POST['cust_name'];
$tot_amount = $_POST['tot_amount'];
$paid_amount = $_POST['paid_amount'];
$bill_type = $_POST['bill_type'];

mysqli_query($conn,"insert into bill (bill_type,acc_id,total_amount,paid_amount,date) values ('$bill_type','$cust_name','$tot_amount','$paid_amount','$date')")or die("Error");


$bill_id = mysqli_insert_id($conn);

$bill_len = count($bill);

for($i=0; $i<$bill_len; $i++){

        $p_name = $bill[$i]['p_name'];
        $qty = $bill[$i]['qty'];
        $price = $bill[$i]['p_price'];
        $total = $bill[$i]['total'];

       mysqli_query($conn,"insert into bill_detail (bill_id,product_id,quantity,price,total) values ('$bill_id','$p_name','$qty','$price','$total')")or die("Error");
  
}



?>