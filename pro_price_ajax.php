<?php
include 'connection.php';
$pro_id = $_POST['pro_id'];
$query =  mysqli_query($conn, "SELECT * FROM product WHERE id='$pro_id'");
$row = mysqli_fetch_assoc($query);
$pro_name = $row['product_name'];
$pro_price = $row['sell_price'];
$varriant_arr = $row['variant'];

$arr = explode(",",$varriant_arr);
$len = count($arr);
$variant_value=[];
for($i=0; $i<=$len-1; $i++){

   $var_id =  $arr[$i];

   $var_query =  mysqli_query($conn, "SELECT * FROM variant WHERE id='$var_id'");
   $row_var = mysqli_fetch_assoc($var_query);

   $variant_value[] = $row_var;
}

$return_values = ['price'=> $pro_price, 'pro_name'=> $pro_name, 'variant_value'=> $variant_value];
echo json_encode($return_values);
?>