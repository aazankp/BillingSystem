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
                <h3 class="card-title">Add Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class='row'>
                  <div class="form-group col-md-4">
                  <label>Product Name</label>
                  <input type="text" class="form-control" placeholder="Enter Product Name" name="p_name">
                  </div>
                  <div class="form-group col-md-4">
                  <label>Purchase Price</label>
                  <input class="form-control" type="text" name="p_price" placeholder="Enter Purchase Price">
                  </div>
                  <div class="form-group col-md-4">
                  <label>Sell Price</label>
                  <input class="form-control" type="text" name="sell_price" placeholder="Enter Sell Price">
                  </div>
                </div>
                <div class='row'>
                  <div class="form-group col-md-4">
                  <label>Opening Stock</label>
                  <input type="text" class="form-control" placeholder="Enter Opening Stock" name="opn_stock">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Unit</label>
                    <input class="form-control" type="text" name="unit" placeholder="Enter Unit">
                  </div>
                  <div class="form-group col-md-4">
                  <label>Image</label>
                  <input class="form-control" type="file" name="img">
                  </div>
                </div>
                <div class='row'>
                  <div class="form-group col-md-4">
                  <label>Variants</label>
                  <select class="select2" name='variants[]'data-placeholder='Select a Variants' multiple='multiple' style="width: 100%;">
                  <?php
                  $variant_query = mysqli_query($conn,'SELECT * FROM variant');
                  while ($variant_row = mysqli_fetch_assoc($variant_query)) {
                    # code...
                  ?>
                    <option value="<?php echo $variant_row['id'];?>"><?php echo $variant_row['variant_name'];?></option>
                    <?php 
                    }
                    ?>
                  </select>
                  </div>
                  <div class="form-group col-md-4">
                  <label>Staus</label>
                  <select class="form-control" name='status' required>
                    <option value="">Select Status</option>
                    <option value="Active">Active</option>
                    <option value="In Active">In Active</option>
                  </select>
                  </div>
                  <!-- <div class="form-group col-md-4">
                  <label>Sell Price</label>
                  <input class="form-control" type="text" name="value" placeholder="Enter Sell Price">
                  </div> -->
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
    // print_r($_POST);
    $pname=$_REQUEST['p_name'];
    $pprice=$_REQUEST['p_price'];
    $sell_price=$_REQUEST['sell_price'];
    $opn_stock=$_REQUEST['opn_stock'];
    $unit=$_REQUEST['unit'];
    $variants=$_REQUEST['variants'];
    $variant_val = implode(",",$variants);
    $status=$_REQUEST['status'];
    $img = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    move_uploaded_file($tmp, "img/".$img);
    $query=mysqli_query($conn,"INSERT INTO product(product_name,purchase_price,sell_price,opening_stock,image,unit,variant,status) value('$pname','$pprice','$sell_price','$opn_stock','$img','$unit','$variant_val','$status')");
    if ($query) {
        # code...
        echo "<div class='alert alert-success text-center'>Data Submitted Successfully</div>";
    }else{
      echo "<div class='alert alert-danger text-center'>Error</div>";
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