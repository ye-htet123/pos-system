<?php include('includes/header.php'); ?>

<div class="modal fade" data-bs-backdrop="static" id="addCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="">Customer name</label>
          <input type="text" id="c_name" class="form-control">
        </div>
        <div class="mb-3">
          <label for="">Customer Phone No</label>
          <input type="number" id="c_phone" class="form-control">
        </div>
        <div class="mb-3">
          <label for="">Customer Email (optional)</label>
          <input type="email" id="c_email" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary saveCustomer">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid px-4">
  <div class="card mt-4 shadow-sm">
    <div class="card-header">
      <h4 class="mb-0">Create Order</h4>
      <a href="customerView.php" class="btn btn-primary float-end">Back</a>
    </div>
    <div class="card-body">
      <?php alertMessage(); ?>
      <form action="orders-code.php" method="POST">
        <div class="row">
          <div class="col-md-3 mb-3">
            <label for=""></label>
                    <select class="mySelect2 form-select" name="product_id">
                <option value="">--- Select Product ---</option>
                <?php 
                    $products = getAll('products');  // Assuming this function fetches all products
                    if ($products) {
                        if (mysqli_num_rows($products) > 0) {
                            // Get the product id from the URL if set
                            $selectedProductId = isset($_GET['id']) ? $_GET['id'] : '';
                            foreach ($products as $prodItem) {
                                // Check if this product matches the selected product
                                $selected = ($prodItem['id'] == $selectedProductId) ? 'selected="selected"' : '';
                ?>
                    <option value="<?= $prodItem['id']; ?>" <?= $selected ?> data-image="../<?= $prodItem['image']; ?>"> <!-- error part -->
                    <td><?= $prodItem['name']; ?> </td> 
                     
                    </option>
                <?php
                            }
                        } else {
                            echo '<option value="">No product found</option>';
                        }
                    } else {
                        echo '<option value="">Something went wrong.</option>';
                    }
                ?>
            </select>
          </div>

          <div class="col-md-3 mb-3">
    <label for="">Quantity</label>
    <input type="number" name="quantity" id="quantityInput" value="1" class="form-control">
</div>

<div class="col-md-3 mb-3 text-end">
    <br>
    <button type="submit" name="addItem" class="btn btn-primary">Add Item</button>
</div>

<script>
    // Ensure that the user cannot input less than 1
    document.getElementById('quantityInput').addEventListener('input', function() {
        if (this.value < 1) {
            this.value = 1;  // Reset to 1 if the value is less than 1
        }
    });
</script>

          
        </div>
      </form>
    </div>
  </div>

  <div class="card mt-3">
    <div class="card-header">
      <h4 class="mb-0">Products</h4>
    </div>
    <div class="card-body" id="productArea">
      <div class="table-responsive mb-3" id="productContent">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Id</th>
              <th  colspan="2" style="text-align:center;">Product Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total Price</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($_SESSION['productItems']) && !empty($_SESSION['productItems'])) {
              $sessionProducts = $_SESSION['productItems'];
              $i = 1;
              foreach ($sessionProducts as $key => $item) :
            ?>
            <tr>
              <td><?= $i++; ?></td>
              <td>  <img src="../<?= $item['image']; ?>" style="width:80px;height:70px;" alt="Img"> </td>   <td><b><?= $item['name']; ?></b></td>
              <td><?= $item['price']; ?></td>
              <td>
                <div class="input-group qtyBox">
                  <input type="hidden" value="<?= $item['product_id']; ?>" class="prodId" />
                  <button class="input-group-text decrement">-</button>
                  <input type="text" value="<?= $item['quantity']; ?>" class="qty quantityInput">
                  <button class="input-group-text increment">+</button>
                </div>
              </td>
              <td><?= number_format($item['price'] * $item['quantity'], 0); ?></td>
              <td>
                <a href="orders-item-delete.php?index=<?= $key; ?>" class="btn btn-danger">Remove</a>
              </td>
            </tr>
            <?php
              endforeach;
            } else {
            ?>
            <tr>
              <td colspan="7" class="text-center">No items added</td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="mt-2">
        <hr>
        <div class="row">
          <div class="col-md-4">
            <label for="">$ Select Payment Method $</label>
            <select name="payment_mode" id="payment_mode" class="form-select">
              <option value="">-------------</option>
              <option value="cash_payment">Cash Payment</option>
              <option value="online_payment">Online Payment</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="">Enter Customer Phone number</label>
            <input type="number" id="cphone" class="form-control" placeholder="09-#########"
             pattern="09[0-9]{9}" title="Phone number must start with '09' and be 11 digits long" required>
          </div>
          <div class="col-md-4">
            <br>
            <button type="button" class="btn btn-warning w-100 proceedToPlace">Proceed to place order</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

  <?php
  // print_r($_SESSION['productItems']);
  //   print_r($_SESSION['productItemIds']);
  ?>
</div>

<?php include('includes/footer.php'); ?>
