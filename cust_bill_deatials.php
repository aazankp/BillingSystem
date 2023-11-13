<?php
include "head.php";
include "connection.php";
$id = $_GET['get_id'];
include "fun.php";
$name_query = mysqli_query($conn,"SELECT * FROM add_account WHERE id='$id'");
$fetch_account = mysqli_fetch_assoc($name_query);
$name = $fetch_account['account_name'];
$account_type = $fetch_account['account_type'];

if (isset($_REQUEST['go'])) {
  $from_date = $_REQUEST['fromdate'];
  $to_date = $_REQUEST['todate'];
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0">Customer Details</h3>
            <!-- <h4 class="m-0">Bills</h4> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class='row'>
            <div class='col-lg-12'>
              <div class='card card-success'>
                <div class='card-header'>
                  <h5>Reporting Date</h5>
                </div>
                <div class='card-body'>
                  <form method='post' action="">
                  <div class='row'>
                    <div class='form-group col-lg-5'>
                      <label>From: </label>
                      <input type="date" value="<?php echo $from_date;?>" class='form-control' name='fromdate' required>
                    </div>
                    <div class='form-group col-lg-5'>
                      <label>To: </label>
                      <input type="date" value="<?php echo $to_date;?>" class='form-control' name='todate'>
                    </div>
                    <div class='form-group col-lg-2'>
                      <label></label>
                      <button type='submit' class='btn btn-info btn-block mt-2 fw-bold' name='go'>GO</button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
<div class="row">
<div class="col-12">
<h4><?php echo $name;?> <small>Report</small></h4>
</div>
</div>

<div class="row">
<div class="col-12 col-md-12">
<div class="card card-primary card-tabs">
<div class="card-header p-0 pt-1">
<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">POS Bills</a>
</li>
<li class="nav-item">
<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Account Bill</a>
</li>
<li class="nav-item">
<a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Transaction</a>
</li>
</ul>
</div>
<div class="card-body">
<div class="tab-content" id="custom-tabs-one-tabContent">
<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
  <a href="print.php?id=<?php echo $id;?>&type=pos&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date;?>" class="btn btn-danger mb-2">Print report</a>
<table id="pos_bill" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
                    <th>S.No</th>
                    <th>Bill Type</th>
                    <th>Name</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Date</th>
                    <th>View Details</th>
                    <th>View Invoice</th>
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
    
    $name_query = mysqli_query($conn,"SELECT * FROM add_account WHERE id='$acc_id'");
    while ($fetch_name = mysqli_fetch_assoc($name_query)) {
    # code...
      $name = $fetch_name['account_name'];
    }
?>
    <tr align='center'>
        <td><?php echo $sno++; ?></td>
        <td><?php echo $bill_type; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $tot_amount; ?></td>
        <td><?php echo $paid_amount; ?></td>
        <td><?php echo $date; ?></td>
        <td><a href="view_bill_details.php?view_id=<?php echo $id; ?>" class='btn btn-info'>View Bill details</a></td>
        <td><a href="invoice.php?invoice_id=<?php echo $id; ?>" class='btn btn-primary'>View Invoice details</a></td>
    </tr>
<?php
    }
?>               
                  </tbody>
                  <tfoot>
                    <tr align='center'>
                      <th rowspan='1' colspan='3'>Grand Total</th>
                      <th rowspan="1" colspan="1"><?php echo get_pos_tot($id,$to_date,$from_date);?></th>
                      <th rowspan='1' colspan='1'><?php echo get_pos_paid($id,$to_date,$from_date);?></th>
                      <th rowspan="1" colspan="1"></th>
                    </tr>   
                </tfoot>
                </table>
</div>
<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
<a href="print.php?id=<?php echo $id;?>&type=account_bill&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date;?>" class="btn btn-danger mb-2">Print report</a>
<table id="acc_bill" class="table table-bordered table-striped">
<thead>
                  <tr align="center">
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Remaining Amount</th>
                    <th>Date</th>
                    <th>Image</th>
                    <th>Update</th>
                    <th>Delete</th>
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

    $name = mysqli_query($conn,"SELECT * FROM add_account WHERE id='$acc_id'");

    while ($row=mysqli_fetch_assoc($name)){
        # code...
    $holder_name=$row['account_name'];
       
    }
   
?>

    <tr align='center'>
        <td><?php echo $sno++; ?></td>
        <td><?php echo $holder_name; ?></td>
        <td><?php echo $tot_amount; ?></td>
        <td><?php echo $paid_amount; ?></td>
        <td><?php echo $rem_amount; ?></td>
        <td><?php echo $date; ?></td>
        <td><?php echo "<img src='img/$img' width='50px' height='50px'>"; ?></td>
        <td><a href="update_cust_bill.php?update_id=<?php echo $id; ?>" class='btn btn-info btn-block'>Update</a></td>
        <td><a href="delete_cust_bill.php?del_id=<?php echo $id; ?>" class='btn btn-danger btn-block'>Delete</a></td>
    </tr>

<?php
    }
?>                 
                  </tbody>
                  <tfoot>
                    <tr align='center'>
                      <th rowspan='1' colspan='2'>Grand Total</th>
                      <th rowspan="1" colspan="1"><?php echo get_acc_tot($id,$to_date,$from_date);?></th>
                      <th rowspan='1' colspan='1'><?php echo get_acc_paid($id,$to_date,$from_date);?></th>
                      <th rowspan='1' colspan='1'><?php echo get_acc_rem($id,$to_date,$from_date);?></th>
                      <th rowspan="1" colspan="4"></th>
                    </tr>   
                </tfoot>
                </table>
</div>
<div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
<a href="print.php?id=<?php echo $id;?>&type=trs&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date;?>" class="btn btn-danger mb-2">Print report</a>
<table id="trs" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
                    <th>S.No</th>
                    <th>Transaction Type</th>
                    <th>Name</th>
                    <th>Paid Amount</th>
                    <th>Description</th>
                    <th>Payment Type</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>

<?php

    $sno=1;
    while ($row=mysqli_fetch_assoc($trsquery)){
        # code...
    $trs_type=$row['transaction_type'];
    $acc_id=$row['account_id'];
    $paid_amount=$row['paid_amount'];
    $des = $row['description'];
    $pay_type=$row['payment_type'];

    $trs_name = mysqli_query($conn,"SELECT * FROM add_account WHERE id='$acc_id'");

    while ($row=mysqli_fetch_assoc($trs_name)){
        # code...
    $holder_name=$row['account_name'];
       
    }
   
?>

    <tr align='center'>
        <td><?php echo $sno++; ?></td>
        <td><?php echo $trs_type; ?></td>
        <td><?php echo $holder_name; ?></td>
        <td><?php echo $paid_amount; ?></td>
        <td><?php echo $des; ?></td>
        <td><?php echo $pay_type; ?></td>
        <td><a href="update_transaction.php?update_id=<?php echo $id; ?>" class='btn btn-info btn-block'>Update</a></td>
        <td><a href="delete_transaction.php?del_id=<?php echo $id; ?>" class='btn btn-danger btn-block'>Delete</a></td>
    </tr>

<?php
    }
?>               
                  </tbody>
                  <tfoot>
                    <tr align='center'>
                      <th rowspan='1' colspan='3'>Grand Total</th>
                      <th rowspan="1" colspan="1"><?php echo get_trs_paid($id,$to_date,$from_date);?></th>
                      <th rowspan='1' colspan='4'></th>
                    </tr>   
                </tfoot>
                </table>
</div>
</div>
</div>

</div>
</div>
        <!-- /.row (main row) -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<?php
include "footer.php";
?>
<script>
  $("#pos_bill").DataTable();
  $("#acc_bill").DataTable();
  $("#trs").DataTable();
</script>



