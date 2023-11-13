<?php
function get_account_balance($id){  
    include "connection.php";
   $query1 = mysqli_query($conn, "select opening_balance from add_account where id='$id'");   
    $row1 = mysqli_fetch_assoc($query1);
    $opening_balance = $row1['opening_balance'];
   $query2= mysqli_query($conn, "select sum(remaining_amount) as rem_amt from account_bill where account_id='$id'");   
    $row2 = mysqli_fetch_assoc($query2);
    $rem = $row2['rem_amt'];
    $query3= mysqli_query($conn, "select sum(paid_amount) as paid_amt from transaction where account_id='$id'");
    $row3 = mysqli_fetch_assoc($query3);
    $paid = $row3['paid_amt'];
    $pay = $rem - $paid;
    $new_bal = $pay + $opening_balance;
if ($new_bal) {
    # code...
    return $new_bal;
}
}

// cust_bill_details functions
function get_pos_tot($id,$to_date,$from_date){
    include "connection.php";
    if($from_date & $to_date){
    $pos_tot = mysqli_query($conn, "SELECT sum(total_amount) as tot_sum FROM bill WHERE acc_id='$id' AND date>='$from_date' AND date<='$to_date'");
    $fetch_pos_tot = mysqli_fetch_assoc($pos_tot);
    $pos_tot_sum = $fetch_pos_tot['tot_sum'];
return $pos_tot_sum;
}else {
    $pos_tot = mysqli_query($conn, "SELECT sum(total_amount) as tot_sum FROM bill WHERE acc_id='$id'");
    $fetch_pos_tot = mysqli_fetch_assoc($pos_tot);
    $pos_tot_sum = $fetch_pos_tot['tot_sum'];
return $pos_tot_sum;
}
}
function get_pos_paid($id,$to_date,$from_date){
    include "connection.php";
    if($from_date & $to_date){
    $pos_paid = mysqli_query($conn, "SELECT sum(paid_amount) as paid_sum FROM bill WHERE acc_id='$id' AND date>='$from_date' AND date<='$to_date'");
    $fetch_pos_paid = mysqli_fetch_assoc($pos_paid);
    $pos_paid_sum = $fetch_pos_paid['paid_sum'];
return $pos_paid_sum;
}else{
    $pos_paid = mysqli_query($conn, "SELECT sum(paid_amount) as paid_sum FROM bill WHERE acc_id='$id'");
    $fetch_pos_paid = mysqli_fetch_assoc($pos_paid);
    $pos_paid_sum = $fetch_pos_paid['paid_sum'];
return $pos_paid_sum;
}
}
function get_acc_tot($id,$to_date,$from_date){
    include "connection.php";
    if($from_date & $to_date){
    $acc_tot = mysqli_query($conn, "SELECT sum(total_amount) as total_sum FROM account_bill WHERE account_id='$id' AND date>='$from_date' AND date<='$to_date'");
    $fetch_acc_tot = mysqli_fetch_assoc($acc_tot);
    $acc_tot_sum = $fetch_acc_tot['total_sum'];
return $acc_tot_sum;
}else{
        $acc_tot = mysqli_query($conn, "SELECT sum(total_amount) as total_sum FROM account_bill WHERE account_id='$id'");
        $fetch_acc_tot = mysqli_fetch_assoc($acc_tot);
        $acc_tot_sum = $fetch_acc_tot['total_sum'];
    return $acc_tot_sum;
}
}
function get_acc_paid($id,$to_date,$from_date){
    include "connection.php";
    if($from_date & $to_date){
    $acc_paid = mysqli_query($conn, "SELECT sum(paid_amount) as paid_sum FROM account_bill WHERE account_id='$id' AND date>='$from_date' AND date<='$to_date'");
    $fetch_acc_paid = mysqli_fetch_assoc($acc_paid);
    $acc_paid_sum = $fetch_acc_paid['paid_sum'];
return $acc_paid_sum;
}else{
    $acc_paid = mysqli_query($conn, "SELECT sum(paid_amount) as paid_sum FROM account_bill WHERE account_id='$id'");
    $fetch_acc_paid = mysqli_fetch_assoc($acc_paid);
    $acc_paid_sum = $fetch_acc_paid['paid_sum'];
return $acc_paid_sum;
}
}
function get_acc_rem($id,$to_date,$from_date){
    include "connection.php";
    if($from_date & $to_date){
    $acc_rem = mysqli_query($conn, "SELECT sum(remaining_amount) as rem_sum FROM account_bill WHERE account_id='$id' AND date>='$from_date' AND date<='$to_date'");
    $fetch_acc_rem = mysqli_fetch_assoc($acc_rem);
    $acc_rem_sum = $fetch_acc_rem['rem_sum'];
return $acc_rem_sum;
}else{
    $acc_rem = mysqli_query($conn, "SELECT sum(remaining_amount) as rem_sum FROM account_bill WHERE account_id='$id'");
    $fetch_acc_rem = mysqli_fetch_assoc($acc_rem);
    $acc_rem_sum = $fetch_acc_rem['rem_sum'];
return $acc_rem_sum;
}
}
function get_trs_paid($id,$to_date,$from_date){
    include "connection.php";
    if($from_date & $to_date){
    $trs_paid = mysqli_query($conn, "SELECT sum(paid_amount) as paid_trs_sum FROM transaction WHERE account_id='$id' AND date>='$from_date' AND date<='$to_date'");
    $fetch_trs_paid = mysqli_fetch_assoc($trs_paid);
    $trs_paid_sum = $fetch_trs_paid['paid_trs_sum'];
return $trs_paid_sum;
}else{
    $trs_paid = mysqli_query($conn, "SELECT sum(paid_amount) as paid_trs_sum FROM transaction WHERE account_id='$id'");
    $fetch_trs_paid = mysqli_fetch_assoc($trs_paid);
    $trs_paid_sum = $fetch_trs_paid['paid_trs_sum'];
return $trs_paid_sum;
}
}

// Sale_report functions
?>