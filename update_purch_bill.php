<?php
include "connection.php";
$day = date('d');
$month = date('m');
$year = date('Y');
$today = $year . '-' . $month . '-' . $day;
$id=$_GET['update_id'];
$query=mysqli_query($conn,"SELECT * FROM account_bill WHERE id='$id'");
while ($row=mysqli_fetch_assoc($query)){
  # code...
  $acc_id=$row['account_id'];
  $tot_amount=$row['total_amount'];
  $paid_amount=$row['paid_amount'];
  $rem_amount = $row['remaining_amount'];
  $date=$row['date'];
  $img=$row['image'];
  $des=$row['description'];  
}
if (isset($_POST['sub'])) {
  # code...
  $acc_id = $_POST['account'];
  $tot_amount = $_POST['tot_amount'];
  $paid_amount = $_POST['paid_amount'];
  $rem_amount = $_POST['rem_amount'];
  $date = $_POST['date'];
  $des = $_POST['des'];
  $bill_type = $_POST['bill_type'];
  $up_bill = $_FILES['up_bill']['name'];
  $tmp = $_FILES['up_bill']['tmp_name'];
  move_uploaded_file($tmp, "img/".$up_bill);
  $update_img = $_POST['update_img'];
if ($up_bill !='') {
  # code...
  $query = mysqli_query($conn,"UPDATE account_bill SET account_id='$acc_id',total_amount='$tot_amount',paid_amount='$paid_amount',remaining_amount='$rem_amount',date='$date',image='$up_bill',description='$des',bill_type='$bill_type' WHERE id='$id'");
  header("location:view_customer_bill.php");
}else{
  $query = mysqli_query($conn,"UPDATE account_bill SET account_id='$acc_id',total_amount='$tot_amount',paid_amount='$paid_amount',remaining_amount='$rem_amount',date='$date',image='$update_img',description='$des',bill_type='$bill_type' WHERE id='$id'");
  header("location:view_customer_bill.php");
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
            <h1>Update Purchaser Bill</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Update Purchaser Bill</li>
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
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Purchaser Bill</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method='post' enctype='multipart/form-data'>
                <div class="card-body">
                  <div class="form-group row">
                  <div class="col-md-4">
                    <label>Select Account</label>
                    <select class="form-control" id='account' name="account" required>

                      <?php
                      
                      $fetch=mysqli_query($conn,"SELECT * FROM add_account WHERE account_type='purchaser'");

                        while ($row=mysqli_fetch_assoc($fetch)){
                            # code...
                          $op_balance = $row['opening_balance'];
                      
                      ?>

                      <option value="<?php echo $row['id']; ?>" data-id="<?php echo $row['opening_balance']; ?>"> <?php echo $row['account_name']; ?> </option>

                      <?php
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Opeining Balance</label>
                    <input type="number" class="form-control" value='<?php echo $op_balance;?>' id='opn_bal' name="opn_bal">
                  </div>
                  <div class="col-md-4">
                    <label>Total Amount</label>
                    <input type="number" class="form-control" value='<?php echo $tot_amount;?>' id="tot_amount" name="tot_amount">
                  </div>
                  </div>
                  <!-- /.row -->

                  <div class="form-group row">
                  <div class="col-md-4">
                    <label>Paid Amount</label>
                    <input type="number" class="form-control" value='<?php echo $paid_amount;?>' id='paid_amount' name="paid_amount">
                  </div>
                  <div class="col-md-4">
                    <label>Remaining Amount</label>
                    <input type="number" class="form-control" value='<?php echo $rem_amount;?>' id='rem_amount' name="rem_amount">
                  </div>
                  <div class="col-md-4">
                    <label>Date</label>
                    <input type="date" class="form-control" value='<?php echo $today; ?>' name="date">
                  </div>
                  </div>
                  <!-- ./row -->

                  <div class="form-group">
                    <label>Upload Bill</label>
                    <input type="file" class="form-control" value='<?php echo $img;?>' name="up_bill">
                    <input type="hidden" value="<?php echo $img;?>" name='update_img'>
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" value='<?php echo $des;?>' name="des">
                  </div>
                </div>

                <input type="hidden" value="Sell" name="bill_type"/>
                <!-- /.card-body -->

                <div class="card-footer text-center">
                  <button type='submit' class="btn btn-primary" name="sub">Update Data</button>
                </div>
            </form>
            </div>
            <!-- /.card -->
</div>
</div>
</div>
</section>


<?php
include "footer.php";
?>
<script>
  $(document).ready(function(){
    $('#account').change(function(){
        opt=$(this).find(':selected').attr('data-id');
        opn_bal = $('#opn_bal').val(opt);
    });
    $('#paid_amount').keyup(function(){
      tot_amount = $('#tot_amount').val();
      paid_amount = $('#paid_amount').val();
      res = parseInt(tot_amount) - parseInt(paid_amount);
      $('#rem_amount').val(res);
    });
    $('#tot_amount').keyup(function(){
      tot_amount = $('#tot_amount').val();
      paid_amount = $('#paid_amount').val();
      res = parseInt(tot_amount) - parseInt(paid_amount);
      $('#rem_amount').val(res);
    });
  });
</script>