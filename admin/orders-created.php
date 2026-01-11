<?php include('includes/header.php'); ?>

<style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --success: #4cc9f0;
        --dark: #2b2d42;
        --light: #f8f9fa;
        --danger: #e63946;
        --warning: #ffaa00;
        --gray: #8d99ae;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f0f4f8 0%, #e6e9ff 100%);
        min-height: 100vh;
        color: var(--dark);
        padding: 20px;
    }

    .card {
        border-radius: 0px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        overflow: hidden;
        margin-bottom: 1.5rem;
        background: white;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        background: linear-gradient(90deg, rgba(22, 145, 202, 0.7), var(--secondary));
        color: white;
        border-radius: 0 !important;
        border: none;
        padding: 1.2rem 1.5rem;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .card-title i {
        color: white;
    }

    .btn-primary {
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background: linear-gradient(90deg,  rgba(53, 31, 196, 0.8), var(--primary));
        transform: translateY(-2px);
    }

    .btn-danger {
        background: var(--danger);
        border: none;
        border-radius: 8px;
    }

    .btn-warning {
        background: var(--warning);
        border: none;
        color: var(--dark);
        font-weight: 600;
        border-radius: 8px;
    }

    .btn-outline-primary {
        border-color:rgba(137, 130, 213, 0.94);
        color:  rgba(224, 212, 212, 0.94);
    }

    .btn-outline-primary:hover {
        background: transparent;
        color: white;
    }

    .modal-content {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        color: white;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .modal-title {
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .table th {
        background: #f8f9ff;
        color: var(--dark);
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        border-bottom: 2px solid #e0e7ff;
    }

    .table td {
        padding: 1rem;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }

    .table tr:last-child td {
        border-bottom: none;
    }

    .table tr:hover {
        background-color: #f8f9ff;
    }

    .table img {
        width: 80px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #e0e7ff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .qtyBox {
        max-width: 150px;
        border: 1px solid #e0e7ff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .qtyBox .input-group-text {
        background: #e0e7ff;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .qtyBox .input-group-text:hover {
        background: var(--primary);
        color: white;
    }

    .quantityInput {
        text-align: center;
        font-weight: 600;
        border: none;
        background: white;
        height: 100%;
        padding: 0.5rem;
    }

    .form-control, .form-select {
        border: 1px solid #e0e7ff;
        border-radius: 8px;
        padding: 0.8rem 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        outline: none;
    }

    .payment-section {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-top: 1.5rem;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e0e7ff;
    }

    .section-title i {
        color: var(--primary);
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 3rem 0;
    }

    .empty-state i {
        font-size: 4rem;
        color: #e0e7ff;
        margin-bottom: 1rem;
    }

    .empty-state h5 {
        color: var(--gray);
    }

    @media (max-width: 992px) {
        .table-responsive {
            overflow-x: auto;
        }
        
        .card-title {
            font-size: 1.3rem;
        }
    }
</style>

<div class="modal fade" data-bs-backdrop="static" id="addCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-user-plus me-2"></i>Add Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for=""><i class="fas fa-user me-1"></i> Customer Name</label>
          <input type="text" id="c_name" class="form-control" placeholder="Enter customer name">
        </div>
        <div class="mb-3">
          <label for=""><i class="fas fa-phone me-1"></i> Phone Number</label>
          <input type="number" id="c_phone" class="form-control" placeholder="09-#########">
        </div>
        <div class="mb-3">
          <label for=""><i class="fas fa-envelope me-1"></i> Email (optional)</label>
          <input type="email" id="c_email" class="form-control" placeholder="customer@example.com">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary saveCustomer"><i class="fas fa-save me-1"></i> Save</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid px-4">
  <div class="card mt-4">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <div class="card-title">
          <i class="fas fa-shopping-cart"></i>
          <h4 class="mb-0">Create New Order</h4>
        </div>
        <a href="products.php" class="btn btn-outline-primary">
          <i class="fas fa-ararrowrow-left me-1"></i> Back to Products
        </a>
      </div>
    </div>
    
    <div class="card-body">
      <?php alertMessage(); ?>
      
      <form action="orders-code.php" method="POST">
        <div class="row g-3">
          <div class="col-md-5">
            <label for=""><i class="fas fa-box me-1"></i> Select Product</label>
            <select class="mySelect2 form-select" name="product_id">
              <option value="">--- Select Product ---</option>
              <?php 
                $products = getAll('products');
                if ($products) {
                  if (mysqli_num_rows($products) > 0) {
                    $selectedProductId = isset($_GET['id']) ? $_GET['id'] : '';
                    foreach ($products as $prodItem) {
                      $selected = ($prodItem['id'] == $selectedProductId) ? 'selected="selected"' : '';
              ?>
                <option value="<?= $prodItem['id']; ?>" <?= $selected ?>>
                  <?= $prodItem['name']; ?> - $<?= number_format($prodItem['price'], 2) ?>
                  
                </option>
                
              <?php
                    }
                  } else {
                    echo '<option value="">No products available</option>';
                  }
                } else {
                  echo '<option value="">Something went wrong</option>';
                }
              ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for=""><i class="fas fa-hashtag me-1"></i> Quantity</label>
            <input type="number" name="quantity" id="quantityInput" class="form-control" min="1" value="1" placeholder="Quantity">
          </div>

          <div class="col-md-4 d-flex align-items-end">
            <button type="submit" name="addItem" class="btn btn-primary w-100">
              <i class="fas fa-cart-plus me-1"></i> Add to Order
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <i class="fas fa-receipt me-1"></i>
        <h4 class="mb-0">Order Items</h4>
      </div>
    </div>
    
    <div class="card-body" id="productArea">
      <div class="table-responsive mb-3" id="productContent">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($_SESSION['productItems']) && !empty($_SESSION['productItems'])) {
              $sessionProducts = $_SESSION['productItems'];
              $i = 1;
              foreach ($sessionProducts as $key => $item) :
                $productId = $item['product_id'];
                $query = "SELECT quantity FROM products WHERE id = '$productId' LIMIT 1";
                $result = mysqli_query($conn, $query);
                $availableStock = 0;
                if ($result && mysqli_num_rows($result) > 0) {
                  $product = mysqli_fetch_assoc($result);
                  $availableStock = $product['quantity'];
                  $_SESSION['stock'] = $availableStock;
                }
            ?>
            
            <tr>
              <td><?= $i++; ?></td>
              <td>
                <div class="d-flex align-items-center">
                  <img src="../<?= $item['image']; ?>" class="img-fluid" style="width:80px;height:70px;" alt="Product">
                  <div class="ms-3">
                    <div class="fw-bold product-item" ><?= $item['name']; ?></div>
                    <div class="text-muted small">Stock: <?= $availableStock ?></div>
                  </div>
                </div>
              </td>
              <td>$<?= number_format($item['price'], 2) ?></td>
              <td>
                <div class="input-group qtyBox" data-max="<?= $availableStock; ?>">
                  <input type="hidden" value="<?= $item['product_id']; ?>" class="prodId" />
                  <input type="hidden" value="<?= $availableStock; ?>" class="prodStk" />
                  <button type="button" class="input-group-text decrement">-</button>
                  <input type="text" value="<?= $item['quantity']; ?>" class="qty quantityInput form-control text-center" 
                         onkeydown="if(event.key === 'Enter') location.reload();">
                  <button type="button" class="input-group-text increment">+</button>
                </div>
              </td>
              <td class="fw-bold">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
              <td>
                <a href="orders-item-delete.php?index=<?= $key; ?>" class="btn btn-danger btn-sm">
                  <i class="fas fa-trash-alt me-1"></i> Remove
                </a>
              </td>
            </tr>
            <?php
              endforeach;
            }
             else {
            ?>
            <tr>
              <td colspan="6">
                <div class="empty-state">
                  <i class="fas fa-shopping-basket"></i>
                  <h5>No items added to order</h5>
                  <p class="text-muted">Add products from the form above</p>
                </div>
              </td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        <?php
$cartNotEmpty = (isset($_SESSION['productItems']) && !empty($_SESSION['productItems'])) ? '1' : '0';
?>
<input type="hidden" id="cart_not_empty" value="<?= $cartNotEmpty ?>">
      </div>

      <div class="payment-section">
        <h5 class="section-title">
          <i class="fas fa-credit-card"></i> Payment Details
        </h5>
        
        <div class="row g-3">
          <div class="col-md-4">
            <label for=""><i class="fas fa-money-bill-wave me-1"></i> Payment Method</label>
            <select name="payment_mode" id="payment_mode" class="form-select">
              <option value="">Select payment method</option>
              <option value="cash_payment">Cash Payment</option>
              <option value="online_payment">Online Payment</option>
            </select>
          </div>
          
          <div class="col-md-4">
            <label for=""><i class="fas fa-phone me-1"></i> Customer Phone</label>
            <div class="input-group">
              <input type="tel" id="cphone" class="form-control" 
                    placeholder="09-#########"
                    pattern="09[0-9]{9}" 
                    title="Phone number must start with '09' and be 11 digits long"
                    maxlength="11"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    
              <button type="button" class="btn btn-outline-primary" 
                      data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                <i class="fas fa-plus"></i>
              </button>
            </div>

          </div>
          
          <div class="col-md-4 d-flex align-items-end">
            <button type="button" class="btn btn-warning w-100 proceedToPlace">
              <i class="fas fa-check-circle me-1"></i> Complete Order
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<?php include('includes/footer.php'); ?>