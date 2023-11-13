<?php
include "connection.php";
include "head.php";
$day = date('d');
$month = date('m');
$year = date('Y');
$today = $year . '-' . $month . '-' . $day;
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Purchaser Bill</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Add Purchaser Bill</li>
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
                <h3 class="card-title">Add Puchaser Bill</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method='post' enctype='multipart/form-data'>
                <div class="card-body">
                  <div class="form-group row">
                  <div class="col-md-4">
                    <label>Select Account</label>
                    <select class="form-control" id='account' name="account" required>
                      <option value="">Select Account</option>
                      <?php                     
                      $fetch=mysqli_query($conn,"SELECT * FROM add_account WHERE account_type='purchaser'");
                        while ($row=mysqli_fetch_assoc($fetch)){
                            # code...
                        $account_type=$row['account_type'];                                       
                      ?>
                      <option value="<?php echo $row['id']; ?>" data-id="<?php echo $row['opening_balance']; ?>"> <?php echo $row['account_name']; ?> </option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Opeining Balance</label>
                    <input type="number" class="form-control" placeholder="Balance" id='opn_bal' name="opn_bal">
                  </div>
                  <div class="col-md-4">
                    <label>Total Amount</label>
                    <input type="number" class="form-control" placeholder="Total Amount" id='tot_amount' name="tot_amount">
                  </div>
                  </div>
                  <!-- /.row -->

                  <div class="form-group row">
                  <div class="col-md-4">
                    <label>Paid Amount</label>
                    <input type="number" class="form-control" placeholder="Paid Amount" id='paid_amount' name="paid_amount">
                  </div>
                  <div class="col-md-4">
                    <label>Remaining Amount</label>
                    <input type="number" class="form-control" placeholder="Remaing Amount" id='rem_amount' name="rem_amount">
                  </div>
                  <div class="col-md-4">
                    <label>Date</label>
                    <input type="date" class="form-control" value='<?php echo $today; ?>' name="date">
                  </div>
                  </div>
                  <!-- ./row -->

                  <div class="form-group">
                    <label>Upload Bill</label>
                    <input type="file" class="form-control" name="up_bill">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" placeholder="Description" name="des">
                  </div>
                </div>

                <input type="hidden" value="Purchaser" name="bill_type"/>
                <!-- /.card-body -->

                <div class="card-footer text-center">
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
?>
<script>
  $(document).ready(function(){
    $('#account').change(function(){
        opt=$(this).find(':selected').attr('data-id');
        opn_bal = $('#opn_bal').val(opt);
      });
      $('#tot_amount').keyup(function(){
        tot_amount = $('#tot_amount').val();
        paid_amount = $('#paid_amount').val();
        res = parseInt(tot_amount) - parseInt(paid_amount);
        $('#rem_amount').val(res);
      });
    $('#paid_amount').keyup(function(){
      tot_amount = $('#tot_amount').val();
      paid_amount = $('#paid_amount').val();
      res = parseInt(tot_amount) - parseInt(paid_amount);
      $('#rem_amount').val(res);
    });
  });
</script>

<?php
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

$query = mysqli_query($conn,"INSERT INTO account_bill (account_id,total_amount,paid_amount,remaining_amount,date,image,description,bill_type) values ('$acc_id','$tot_amount','$paid_amount','$rem_amount','$date','$up_bill','$des','$bill_type')");

if ($query) {
    # code...
    echo "<div class='alert alert-success text-center'>Data Submitted Successfully</div>";
}else{
  echo "<div class='alert alert-danger text-center'>Error</div>";
}
}
?>