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
            <h1>View Purchaser Bill</h1>
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
                <h3 class="card-title">DataTable with default features</h3>
                <a href="purchaser_bill.php" class="btn btn-info float-right">Add Purchaser Bill</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
                    <th>S.No</th>
                    <th>Account Holder Name</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Remaining Amount</th>
                    <th>Date</th>
                    <th>Image</th>
                  </tr>
                  </thead>
                  <tbody>
<?php
    $query=mysqli_query($conn,"SELECT * FROM account_bill WHERE bill_type='purchaser'");
    $sno=1;
    while ($row=mysqli_fetch_assoc($query)){
        # code...
    $id = $row['id'];
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
        <td><a href="update_purch_bill.php?update_id=<?php echo $id; ?>" class='btn btn-info btn-block'>Update</a></td>
        <td><a href="delete_purch_bill.php?del_id=<?php echo $id; ?>" class='btn btn-danger btn-block'>Delete</a></td>
    </tr>
<?php
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
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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