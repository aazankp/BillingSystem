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
            <h1>View Bills</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">POS Bills</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
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
    $query=mysqli_query($conn,"SELECT * FROM bill");
    $sno=1;
    while ($row=mysqli_fetch_assoc($query)){
      # code...
      $id=$row['id'];
      $bill_type=$row['bill_type'];
      $acc_id=$row['acc_id'];
      $tot_amount=$row['total_amount'];
      $paid_amount=$row['paid_amount'];
      $date=$row['date'];
    
    $name_query = mysqli_query($conn,"SELECT * FROM add_account WHERE id='$acc_id'");
    while ($fetch_name = mysqli_fetch_assoc($name_query)) {
    # code...
      $name = $fetch_name['account_name'];
?>
    <tr align='center'>
        <td><?php echo $sno++; ?></td>
        <td><?php echo $bill_type; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $tot_amount; ?></td>
        <td><?php echo $paid_amount; ?></td>
        <td><?php echo $date; ?></td>
        <td><a href="view_bill_details.php?view_id=<?php echo $acc_id; ?>" class='btn btn-info'>View Bill details</a></td>
        <td><a href="invoice.php?invoice_id=<?php echo $acc_id; ?>" class='btn btn-primary'>View Invoice details</a></td>
    </tr>
    <?php
  }
    }
?>               
                  </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark"> 
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<?php
include "footer.php";
?>
  <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>