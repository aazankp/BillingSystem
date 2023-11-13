<?php
include 'connection.php';
include "head.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Products</h1>
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
                    <th>Product Name</th>
                    <th>Purchase Price</th>
                    <th>Sell Price</th>
                    <th>Opening Stock</th>
                    <th>Unit</th>
                    <th>Image</th>
                    <th>Variants</th>
                    <th>status</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                  </thead>

                  <tbody>

<?php
    $query=mysqli_query($conn,"SELECT * FROM product");
    $sno=1;
    while ($row=mysqli_fetch_assoc($query)){
        # code...
    $id=$row['id'];
    $pname=$row['product_name'];
    $pprice=$row['purchase_price'];
    $sell_price=$row['sell_price'];
    $opn_stock=$row['opening_stock'];
    $unit=$row['unit'];
    $img=$row['image'];
    $variants=$row['variant'];
    $status=$row['status'];
?>
    <tr align='center'>
        <td><?php echo $sno++; ?></td>
        <td><?php echo $pname; ?></td>
        <td><?php echo $pprice; ?></td>
        <td><?php echo $sell_price; ?></td>
        <td><?php echo $opn_stock; ?></td>
        <td><?php echo $unit; ?></td>
        <td><?php echo "<img src='img/$img' width='50px' height='50px'>";?></td>
        <td><?php echo $variants; ?></td>
        <td><?php echo $status; ?></td>
        <td><a href="update_product.php?update_id=<?php echo $id; ?>" class='btn btn-info btn-block'>Update</a></td>
        <td><a href="delete_product.php?del_id=<?php echo $id; ?>" class='btn btn-danger btn-block'>Delete</a></td>
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