<?php
include "connection.php";
include_once "head.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Transaction</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Add Transaction</li>
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
                <h3 class="card-title">Add Transaction</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method='post' enctype='multipart/form-data'>
                <div class="card-body">
                  <div class="row">
                  <div class="form-group col-md-4">
                  <label>Transaction Type</label>
                    <select class="form-control" id='trs_type' name="trs_type" required>
                    <option value="">Select transaction type</option>
                    <option value="Customer">Customer</option>
                    <option value="Purchaser">Purchaser</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Select Account</label>
                    <select class="form-control" id='account' name="account" required>

                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Opeining Balance</label>
                    <input type="text" class="form-control" id='opn_bal' name="opn_bal">
                  </div>
                  </div>
                  <!-- /.row -->

                  <div class="row">
                  <div class="form-group col-md-4">
                    <label>Paid Amount</label>
                    <input type="number" class="form-control" id='paid_amount' name="paid_amount">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Payment Type</label>
                    <select class="form-control" id='pay_type' name="pay_type" required>
                    <option value="">Select payment type</option>
                    <option value="Cash">Cash</option>
                    <option value="Bank Deposit">Bank Deposit</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Date</label>
                    <input type="date" class="form-control" id='date' name="date" value='<?php echo date('Y-m-d');?>'>
                  </div>
                  <div class="form-group col-md-12">
                    <label>Description</label>
                    <input type="text" class="form-control" id='des' name="des">
                  </div>
                  </div>
                  <!-- ./row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <button type='submit' class="btn btn-primary" name="sub">Submit Data</button>
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
    $('#trs_type').change(function(){
        acc_type = $(this).val();
        //  alert(acc_type);
        $.post('fetch_transaction_name.php',
          {
            acc_type : acc_type       
          },
            function(result) {
              $('#account').html(result);
            }
        );
        $('#account').change(function(){
            opt=$(this).find(':selected').attr('data-id');
            opn_bal = $('#opn_bal').val(opt);
        });
    });
  });
</script>
<?php
if (isset($_POST['sub'])) {
  # code...
$trs_type = $_POST['trs_type'];
$acc_name = $_POST['account'];
$paid_amount = $_POST['paid_amount'];
$date = $_POST['date'];
$des = $_POST['des'];
$pay_type = $_POST['pay_type'];

$query = mysqli_query($conn, "INSERT INTO transaction (transaction_type,account_id,paid_amount,description,payment_type,date) values('$trs_type','$acc_name','$paid_amount','$des','$pay_type','$date')");
if ($query) {
  echo "<div class='alert alert-success text-center'>Data Submitted Successfully</div>";
}else{
  echo "<div class='alert alert-danger text-center'>Error</div>";
}
}
?>
