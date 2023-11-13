<?php
include "connection.php";
$id = $_POST['id'];
$select_query = mysqli_query($conn,"SELECT * FROM bill WHERE acc_id='$id'");
while ($fetch = mysqli_fetch_assoc($select_query)){
$bill_id = $fetch['id'];
$grand_total = $fetch['total_amount'];
$date = $fetch['date'];
}
    $query = mysqli_query($conn,"SELECT * FROM bill_detail WHERE bill_id='$bill_id'");
    while ($row = mysqli_fetch_assoc($query)) {
        # code...
        $pro_id = $row['product_id'];
        $qty = $row['quantity'];
        $price = $row['price'];
        $total = $row['total'];

        $name = mysqli_query($conn,"SELECT * FROM product WHERE id='$pro_id'");
    while ($row = mysqli_fetch_assoc($name)) {
        # code...
        $pro_name = $row['product_name'];
    }
    $bill=["pro_name"=>"$pro_name","qty"=>"$qty","price"=>"$price","total"=>"$total",];
}
$return_values = ['acc_id'=> $id,'grand_total'=> $grand_total,'date'=> $date,'bill'=> $bill];
echo json_encode($return_values);
?>