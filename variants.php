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
            <h1>General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Add Products</li>
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
                <h3 class="card-title">Add Vairants</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                <div class='row'>
                  <div class="form-group col-md-4">
                  <label>Variant Name</label>
                  <input type="text" class="form-control" name="variant">
                  </div>
                  <div class="form-group col-md-8">
                  <label>Values</label>
                  <input class="form-control" type="text" name="value" placeholder="Enter a value">
                  </div>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="sub">Submit Data</button>
                </div>
                </form>
            </div>
            <!-- /.card -->
</div>
</div>
</div>
</section>

<?php
if (isset($_REQUEST["sub"])) {
    # code...
    $variant=$_REQUEST['variant'];
    $value=$_REQUEST['value'];
    $query=mysqli_query($conn,"INSERT INTO variant(variant_name,variant_value) value('$variant','$value')");
    if ($query) {
        # code...
        echo "<div class='alert alert-success text-center'>Data Submitted Successfully</div>";
    }else{
        echo "<div class='alert alert-success text-center'>Error</div>";
    }
}
include "footer.php";
?>
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()
});
</script>