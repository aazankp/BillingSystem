<?php
include "head.php";
include "connection.php";

$date = date('Y-m-d');

$purch = mysqli_query($conn, "SELECT count(account_type) as purch_sum FROM add_account WHERE account_type='purchaser'");
$fetch_purch = mysqli_fetch_assoc($purch);
$purch_sum = $fetch_purch['purch_sum'];
$cust = mysqli_query($conn, "SELECT count(account_type) as cust_sum FROM add_account WHERE account_type='customer'");
$fetch_cust = mysqli_fetch_assoc($cust);
$cust_sum = $fetch_cust['cust_sum'];
$accounts = mysqli_query($conn, "SELECT count(id) as account_sum FROM add_account");
$fetch_accounts = mysqli_fetch_assoc($accounts);
$accounts_sum = $fetch_accounts['account_sum'];

$purchase = mysqli_query($conn, "SELECT sum(total_amount) as purchase_sum FROM account_bill WHERE bill_type='purchaser' AND date='$date'");
$fetch_purchase = mysqli_fetch_assoc($purchase);
$purchase_sum = $fetch_purchase['purchase_sum'];
$sell = mysqli_query($conn, "SELECT sum(total_amount) as sell_sum FROM account_bill WHERE bill_type='sell' AND date='$date'");
$fetch_sell = mysqli_fetch_assoc($sell);
$sell_sum = $fetch_sell['sell_sum'];
$trs = mysqli_query($conn, "SELECT sum(paid_amount) as trs_sum FROM transaction");
$fetch_trs = mysqli_fetch_assoc($trs);
$trs_sum = $fetch_trs['trs_sum'];
?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
         <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h5 class='fw-bold mb-4'>Product Details</h5>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="view_product.php" class="small-box-footer mt-5">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5 class='fw-bold mb-4'>Bill Details</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!-- <input type="hidden" class='text-break'>
              <input type="hidden"> -->
              <a href="view_bill.php" class="small-box-footer mt-5">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <div class='row'>
                <h5 class='fw-bold mb-0'>Accounts</h5>
                  <div class='col-md-5'>
                    <span>Total Accounts</span>
                  </div>
                  <div class='col-md-7'>
                    <span><?php echo $accounts_sum;?></span>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-md-5'>
                    <span>Purchaser</span>
                  </div>
                  <div class='col-md-7'>
                    <span><?php echo $purch_sum;?></span>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-md-5'>
                    <span>Customer</span>
                  </div>
                  <div class='col-md-7'>
                    <span><?php echo $cust_sum;?></span>
                  </div>
                </div>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="view_account.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h5 class='fw-bold mb-0'>Todays Total Billing Amount</h5>
                <div class='row'>
                  <div class='col-md-5'>
                    <span>Purchase</span>
                  </div>
                  <div class='col-md-7'>
                    <span><?php echo $purchase_sum;?></span>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-md-5'>
                    <span>Sell</span>
                  </div>
                  <div class='col-md-7'>
                    <span><?php echo $sell_sum;?></span>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-md-5'>
                    <span>Transaction</span>
                  </div>
                  <div class='col-md-7'>
                    <span><?php echo $trs_sum;?></span>
                  </div>
                </div>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
                <a href="view_transaction.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
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