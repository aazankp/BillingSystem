<?php

session_start();
$uname=$_SESSION['username'];

if ($uname == "") {
  # code...
  header("location: login.php");
}

include "connection.php";

    $id=$_GET['del_id'];

    $query=mysqli_query($conn,"DELETE FROM add_account WHERE id='$id'");

	if ($query) {
		// code...
		header('location: view_account.php');
	}else{
		echo "Error";
	}

?>