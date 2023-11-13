<?php
include "connection.php";
$id = $_GET['update_id'];
$query=mysqli_query($conn,"SELECT * FROM product WHERE id='$id'");
while ($row = mysqli_fetch_assoc($query)) {
    # code...
    $pname = $row['product_name'];
    $pprice = $row['purchase_price'];
    $sell_price = $row['sell_price'];
    $opn_stock = $row['opening_stock'];
    $unit = $row['unit'];
    $img = $row['image'];
    $variants = $row['variant'];
    $status = $row['status'];
}
if (isset($_POST['sub'])) {
    # code...
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
    $update_img = $_POST['update_img'];
  if ($img !='') {
    # code...
    $query = mysqli_query($conn,"UPDATE product SET product_name='$pname',purchase_price='$pprice',sell_price='$sell_price',opening_stock='$opn_stock',image='$img',unit='$unit',variant='$variant_val',status='$status' WHERE id='$id'");
    header("location: view_product.php");
  }else{
    $query = mysqli_query($conn,"UPDATE product SET product_name='$pname',purchase_price='$pprice',sell_price='$sell_price',opening_stock='$opn_stock',image='$update_img',unit='$unit',variant='$variant_val',status='$status' WHERE id='$id'");
    header("location: view_product.php");
  }
  }
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
                  <input type="text" class="form-control" value='<?php echo $pname;?>' name="p_name">
                  </div>
                  <div class="form-group col-md-4">
                  <label>Purchase Price</label>
                  <input class="form-control" type="text" value='<?php echo $pprice;?>' name="p_price">
                  </div>
                  <div class="form-group col-md-4">
                  <label>Sell Price</label>
                  <input class="form-control" type="text" value='<?php echo $sell_price;?>' name="sell_price">
                  </div>
                </div>
                <div class='row'>
                  <div class="form-group col-md-4">
                  <label>Opening Stock</label>
                  <input type="text" class="form-control"  value='<?php echo $opn_stock;?>' name="opn_stock">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Unit</label>
                    <input class="form-control" type="text" value='<?php echo $unit;?>' name="unit">
                  </div>
                  <div class="form-group col-md-4">
                  <label>Image</label>
                  <input class="form-control" type="file" name="img">
                  <input type="hidden" value='<?php echo $img;?>' name='update_img'>
                  </div>
                </div>
                <div class='row'>
                  <div class="form-group col-md-4">
                  <label>Variants</label>
                  <select class="select2" name='variants' value='<?php echo $variants;?>' multiple='multiple' style="width: 100%;">
                    <option value="Size">Size</option>
                    <option value="Color">Color</option>
                    <option value="Flavour">Flavour</option>
                  </select>
                  </div>
                  <div class="form-group col-md-4">
                  <label>Staus</label>
                  <select class="form-control" value='<?php echo $status;?>' name='status'>
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