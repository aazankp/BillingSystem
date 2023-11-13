<?php
include "connection.php";
$id = $_GET['update_id'];
$fetch_trs = mysqli_query($conn,"SELECT * FROM transaction WHERE id='$id'");
while ($row=mysqli_fetch_assoc($fetch_trs)) {
    # code...
    $acc_id = $row['account_id'];
    $amount = $row['paid_amount'];
    $desc = $row['description'];
}
if (isset($_POST['sub'])) {
    # code...
  $trs_type = $_POST['trs_type'];
  $acc_name = $_POST['account'];
  $paid_amount = $_POST['paid_amount'];
  $des = $_POST['des'];
  $pay_type = $_POST['pay_type'];
  $opn_bal = $_POST['opn_bal'];

  $query = mysqli_query($conn,"UPDATE transaction SET transaction_type='$trs_type',account_id='$acc_name',paid_amount='$paid_amount',description='$des',payment_type='$pay_type' WHERE id='$id'");
  if ($query) {
    header('location: view_transaction.php');
  }else{
    echo "<div class='alert alert-danger text-center'>Error</div>";
  }
  }
include_once "head.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Transaction</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Update Transaction</li>
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
                <h3 class="card-title">Update Transaction</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method='post'>
                <div class="card-body">
                  <div class="form-group row">
                  <div class="col-md-4">
                  <label>Transaction Type</label>
                    <select class="form-control" value='<?php echo $row['account_type'];?>' id='trs_type' name="trs_type" required>
                    <option value="Customer">Customer</option>
                    <option value="Purchaser">Purchaser</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    
                    <?php                      
                      $fetch=mysqli_query($conn,"SELECT * FROM add_account WHERE id='$acc_id'");
                      while ($row=mysqli_fetch_assoc($fetch)){
                        # code...
                        $op_balance = $row['opening_balance'];
                        $name = $row['account_name'];
                      }
                      ?>
                    <label>Select Account</label>
                    <select class="form-control" id='account' name="account" required>
                        <option value=""></option>
                    </select>

                  </div>
                  <div class="col-md-4">
                    <label>Opeining Balance</label>
                    <input type="text" class="form-control" value='<?php echo $op_balance;?>' id='opn_bal' name="opn_bal" style="background: white;">
                  </div>
                  </div>
                  <!-- /.row -->

                  <div class="form-group row">
                  <div class="col-md-4">
                    <label>Paid Amount</label>
                    <input type="number" class="form-control" value='<?php echo $amount?>' id='paid_amount' name="paid_amount">
                  </div>
                  <div class="col-md-4">
                    <label>Payment Type</label>
                    <select class="form-control" value='<?php echo $row['payment_type'];?>' id='pay_type' name="pay_type" required>
                    <option value="Cash">Cash</option>
                    <option value="Bank Deposit">Bank Deposit</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Description</label>
                    <input type="text" class="form-control" value='<?php echo $desc;?>' id='des' name="des">
                  </div>
                  </div>
                  <!-- ./row -->
                </div>
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
<input type="hidden" value="<?php echo $acc_id;?>" id='acc_id'>

<?php
include "footer.php";
?>
<script>
  $(document).ready(function(){
    acc_id = $('#acc_id').val();
    $.post('update_fetch_trs.php',
          {
            acc_id : acc_id       
          },
            function(result) {
              $('#account').html(result);
            }
        );
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