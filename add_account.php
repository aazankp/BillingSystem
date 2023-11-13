<?php
include "connection.php";
include "head.php";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Account</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Add Account</li>
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
                <h3 class="card-title">Add Account</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method='post'>
                <div class="card-body">
                  <div class="form-group">
                    <label>Account Type</label>
                    <select class="form-control" name="acc_type" required>
                      <option value="">Please Select Account type</option>
                      <option value="Customer">Customer</option>
                      <option value="Purchaser">Purchaser</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Account Holder Name</label>
                    <input type="text" class="form-control" placeholder="Full Name" name="acc_name">
                  </div>
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="number" class="form-control" placeholder="Phone" name="phone">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Address" name="address">
                  </div> <div class="form-group">
                    <label>Opening Balance</label>
                    <input type="number" class="form-control" placeholder="Opeing Balance" name="op_balance">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type='submit' class="btn btn-primary" name="sub">Submit Data</button>
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

if (isset($_POST['sub'])) {
  # code...
  $acc_type = $_POST['acc_type'];
  $acc_name = $_POST['acc_name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $op_balance = $_POST['op_balance'];

  $query = mysqli_query($conn, "INSERT INTO add_account (account_type,account_name,phone,address,opening_balance) values('$acc_type','$acc_name','$phone','$address','$op_balance')") or die("Error");

  if ($query) {
    # code...
    echo "<div class='alert alert-success text-center'>Data Submitted Successfully</div>";
}

}

?>