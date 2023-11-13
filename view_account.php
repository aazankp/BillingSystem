<?php
include "connection.php";
include "head.php";
include "fun.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Accounts</h1>
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
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
                    <th>S.No</th>
                    <th>Account Type</th>
                    <th>Account Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Opening Balance</th>
                    <th>New Balance</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>View Details</th>
                  </tr>
                  </thead>
                  <tbody>

<?php

    $query=mysqli_query($conn,"SELECT * FROM add_account");

    $sno=1;

    while ($row=mysqli_fetch_assoc($query)){
        # code...
    $id=$row['id'];
    $acc_type=$row['account_type'];
    $acc_name=$row['account_name'];
    $phone=$row['mobile'];
    $address = $row['address'];
    $op_balance=$row['opening_balance'];
   
?>

    <tr align='center'>
        <td><?php echo $id; ?></td>
        <td><?php echo $acc_type; ?></td>
        <td><?php echo $acc_name; ?></td>
        <td><?php echo $phone; ?></td>
        <td><?php echo $address; ?></td>
        <td><?php echo $op_balance; ?></td>
        <td><?php echo get_account_balance($id);?></td>
        <td><a href="update_account.php?update_id=<?php echo $id; ?>" class='btn btn-info btn-block'>Update</a></td>
        <td><a href="delete_account.php?del_id=<?php echo $id; ?>" class='btn btn-danger btn-block'>Delete</a></td>
        <td><a href="cust_bill_deatials.php?get_id=<?php echo $id; ?>" class='btn btn-success btn-block'>View Details</a></td>
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