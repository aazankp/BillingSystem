<?php
include "connection.php";
$id=$_GET['update_id'];
$query=mysqli_query($conn,"SELECT * FROM add_account WHERE id='$id'");
while ($row=mysqli_fetch_assoc($query)){
  # code...
  $id=$row['id'];
  $account_type=$row['account_type'];
  $account_name=$row['account_name'];
  $holder_phone=$row['mobile'];
  $holder_address=$row['address'];
  $opening_bal=$row['opening_balance'];
}
if (isset($_POST['sub'])) {
  # code...
  $acc_type = $_POST['acc_type'];
  $acc_name = $_POST['acc_name'];
  $mob = $_POST['phone'];
  echo $mob;
  $address = $_POST['address'];
  $op_balance = $_POST['op_balance'];
  $update_query = mysqli_query($conn,"UPDATE add_account SET account_type='$acc_type',account_name='$acc_name',mobile='$mob',address='$address',opening_balance='$op_balance' WHERE id='$id'");
  if ($update_query) {
    # code...
    header('location: view_account.php');
  }else{
    echo "<div class='alert alert-danger text-center'>Error</div>";
  }
}
include "head.php";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Account</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Update Account</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Account</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method='post'>
                <div class="card-body">
                  <div class="form-group">
                    <label>Account Type</label>
                    <select class="form-control" name="acc_type" value='<?php echo $account_type;?>'>
                      <option value="">Please Select Account type</option>
                      <option value="Customer" <?php echo ($account_type == "Customer") ? "selected" : ""; ?> >Customer</option>
                      <option value="Purchaser" <?php echo ($account_type == "Purchaser") ? "selected" : ""; ?>>Purchaser</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Account Holder Name</label>
                    <input type="text" class="form-control" placeholder="Full Name" name="acc_name" value='<?php echo $account_name;?>'>
                  </div>
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="number" class="form-control" placeholder="Phone" name="phone" value='<?php echo $holder_phone;?>'>
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Address" name="address" value='<?php echo $holder_address;?>'>
                  </div> <div class="form-group">
                    <label>Opening Balance</label>
                    <input type="number" class="form-control" placeholder="Opeing Balance" name="op_balance" value='<?php echo $opening_bal;?>'>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type='submit' class="btn btn-primary" name="sub">Update Data</button>
                </div>
            </form>
            </div>
            <!-- /.card -->

            <!-- <div id='done'></div> -->

</div>
</div>
</div>
</section>

<?php
  include "footer.php";
?>