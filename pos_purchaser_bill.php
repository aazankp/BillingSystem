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
          <h1>Purchaser Bill Details</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">General Form</li>
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
              <h3 class="card-title">Add Purchaser Bill</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Purchaser Name</label>
                    <select class="form-control" id="c_name" required>
                      <option value="">Select Purchaser Name</option>
                      <?php
                      $query = mysqli_query($conn, "SELECT * FROM add_account WHERE account_type='purchaser'");
                      while ($row = mysqli_fetch_assoc($query)) {
                        # code...
                        $id = $row['id'];
                        $name = $row['account_name'];
                        ?>
                        <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Date</label>
                    <input type="date" value='<?php echo date('Y-m-d'); ?>' class="form-control" id="date">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Select Product</label>
                    <select class="form-control" id="product_id">
                      <option>Select Product</option>
                      <?php
                      $query = mysqli_query($conn, "select * from product");
                      while ($row = mysqli_fetch_array($query)) {
                        ?>

                        <option value="<?php echo $row['id']; ?>"> <?php echo $row['product_name']; ?> </option>

                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div id='variant_col'>

                </div>
              </div>
              <div class='row'>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="number" class="form-control" placeholder="Enter Price" id="price">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Quantity</label>
                    <input type="number" class="form-control" placeholder="Enter Price" id="quantity" value="1">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Act</label><br>
                    <button class="btn btn-danger" id='add'>Add</button>
                  </div>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class='row'>
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Purchaser Bill Details</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <table class="table table-bordered table-striped" id='table'>
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="area"> </tbody>
              </table>
              <!-- /.row start -->
              <div class='row mt-3'>
                <div class='col-lg-6'>
                  <label class="form-control">Total Amount </label>
                </div>
                <div class='col-lg-6'>
                  <input type='number' class='form-control' placeholder='Total Amount' id='tot_amount' value="0">
                </div>
                <div class='col-lg-6'>
                  <label class="form-control">Paid Amount </label>
                </div>
                <div class='col-lg-6'>
                  <input type='number' class='form-control' placeholder='Paid Amount' id='paid_amount' value="0">
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button class="btn btn-primary" id="submit">Submit Data</button>
            </div>
          </div>
          <!-- /.card -->

        </div>
        <!-- ./col -->
      </div>
      <!-- ./row -->
    </div>
  </section>
</div>
<input type="hidden" value='purchaser' id='bill_type'>

<?php
include "footer.php";
?>
<script>
  $(document).ready(function () {
    $('#product_id').change(function () {
      pro_id = $(this).val();
      $('#variant_col').html(" ");
      $.post("pro_price_ajax.php",
        {
          pro_id: pro_id
        },
        function (result, status) {
          arr = JSON.parse(result);
          price = $('#price').val(arr.price);
          len = arr.variant_value;
          product_name = arr.pro_name;
          html = "";
          len.forEach(function (obj) {
            html += "<div class='col-md-3'><label>Select " + obj.variant_name + "</label><select class='form-control'><option>" + obj.variant_value + "</option></select></div>";
          });

          $('#variant_col').append(html);

        });
    });
    sno = 1;
    var i = 0;
    grandtotal = 0;
    var bill = [];
    $("#add").click(function () {
      qty = $('#quantity').val();
      p_price = $('#price').val();
      tot = (qty * p_price);
      total = tot.toFixed(2);
      cust_name = $('#c_name').val();
      bill_type = $('#bill_type').val();
      date = $('#date').val();
      grandtotal = +total + +grandtotal;
      html = "<tr id='row" + sno + "'>";
      html += "<td>" + sno + "</td>";
      html += "<td>" + product_name + "</td>";
      html += "<td>" + qty + "</td>";
      html += "<td>" + p_price + "</td>";
      html += "<td>" + total + "</td>";
      html += "<td><button td id='" + sno + "' class='btn btn-danger del'>X</button></td>";
      html += "</tr>";
      $("#area").append(html);
      $("#tot_amount").val(grandtotal);
      bill[i] = {
        p_name: p_name,
        qty: qty,
        p_price: p_price,
        total: total,
      }
      sno++;
      i++;
    });
    $(document).on("click", ".del_btn", function () {
      total = $(this).val();
      grandtotal = $("#tot_amount").val();
      rem_total = grandtotal - total;
      $("#tot_amount").val(rem_total);
      id = $(this).attr('id');
      $('#row' + id + '').remove();
    });
    $("#submit").click(function () {
      tot_amount = $('#tot_amount').val();
      paid_amount = $('#paid_amount').val();
      $.post("insert_bill_ajax.php",
        {
          bill: bill,
          date: date,
          cust_name: cust_name,
          tot_amount: tot_amount,
          paid_amount: paid_amount,
          bill_type: bill_type
        },
        function (result, status) {
          alert(status);
        });
    });
  });
</script>