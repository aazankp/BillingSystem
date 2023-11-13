<?php

session_start();
$uname=$_SESSION['username'];

if ($uname == "") {
  # code...
  header("location: login.php");
}

include "connection.php";

    $id=$_GET['del_id'];

    $query=mysqli_query($conn,"DELETE FROM transaction WHERE id='$id'");

	if ($query) {
		// code...
		header('location: view_transaction.php');
	}else{
		echo "Error";
	}

?>