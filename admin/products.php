<?php include('includes/header.php'); ?>

<?php     
  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
  $ownerEmailSubstring = 'owner@gmail.com'; 
  
  ?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
        padding: 30px;
    }

    .cart-container {
        position: relative;
        display: inline-block;
        font-size: 24px;
        cursor: pointer;
    }

    .cart-icon {
        font-size: 30px;
        cursor: pointer;
    }

    .cart-count {
        position: absolute;
        top: -10px;
        right: -15px;
        background: red;
        color: white;
        font-size: 14px;
        padding: 2px 6px;
        border-radius: 50%;
    }

    .card-img-wrapper {
        overflow: hidden;
        height: 200px;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .card-img-wrapper img:hover {
        transform: scale(1.08);
    }

    @media (max-width: 1400px) {
        .card-img-wrapper {
            height: 180px;
        }
    }

    @media (max-width: 1200px) {
        .card-img-wrapper {
            height: 160px;
        }
    }

    @media (max-width: 992px) {
        .card-img-wrapper {
            height: 200px;
        }
    }

    @media (max-width: 768px) {
        .card-img-wrapper {
            height: 250px;
        }
    }
</style>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">
                <a href="index.php" class="btn btn-primary float-end"> > </a>
            </h4>
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-0">Products</h4>
                </div>

                <div class="col-md-8">
                    <form action="#" method="GET">
                        <div class="row g-1">
                            <div class="col-md-4">
                                <select name="category" class="form-select">
                                    <option value="">Select Category</option>
                                    <?php
                                    $query = "SELECT * FROM categories";
                                    $result = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $category_id = $row['id'];
                                            $category_name = $row['name'];
                                            $selected = (isset($_GET['category']) && $_GET['category'] == $category_id) ? 'selected="selected"' : '';
                                            echo "<option value=\"$category_id\" $selected>$category_name</option>";
                                        }
                                    } else {
                                        echo "<option value=\"\">No Categories Available</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="products.php" class="btn btn-danger">Reset</a>
                            </div>

                            <?php
                        $cartCount = isset($_SESSION['productItems']) ? count($_SESSION['productItems']) : 0;
                        ?>
                        <div class="col-md-4">
                        <a href="orders-created.php">
                            <div class="cart-container">
                            🛒
                            <span class="cart-count" id="cart-count"><?= $cartCount ?></span>
                            </div>
                        </a>
                        </div>


                           
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <?php alertMessage(); ?>

            <?php 
            $query = "SELECT * FROM products";
            if (isset($_GET['category']) && $_GET['category'] != '') {
                $category_id = mysqli_real_escape_string($conn, $_GET['category']);
                $query = "SELECT * FROM products WHERE category_id='$category_id'";
            }

            $products = mysqli_query($conn, $query);

            if (!$products) {
                echo '<h4>Something went wrong.</h4>';
                return false;
            }

            if (mysqli_num_rows($products) > 0) {
            ?>
                <div class="row row-cols-xxl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-4">
                    <?php 
                       
                        foreach($products as $Item):
                           
                    ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-img-wrapper">
                                <img src="../<?= $Item['image']; ?>" alt="Product Image">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"> <?= $Item['name'] ?></h5>
                                <h5 class="card-title"><?= $Item['price'] ?> $</h5>
                                <p class="card-text">
                                    Stock: 
                                    <?php 
                                    if ($Item['quantity']  <1) {
                                        echo '<span class="badge bg-danger ">Out of Stock</span>';
                                    } else {
                                        if ($Item['status'] == 1) {
                                            echo '<span class="badge bg-danger">Out of Stock</span>';
                                        } else {
                                            echo '<span class="badge bg-warning">' . $Item['quantity'] . '</span>';

                                        }
                                    }
                                    ?>
                                </p>
<div class="mt-auto d-grid gap-2">
    <!-- Add to Cart Button (full-width) -->
    <button type="submit" name="addItem" class="btn btn-modern btn-cart flex-grow-1 add-to-cart-btn" data-product-variant="<?= $Item['id']; ?>" >
        <i class="fas fa-cart-plus me-2"></i>Add to Cart
    </button>

    <?php if (strpos($_SESSION['loggedInUser']['email'], $ownerEmailSubstring) !== false): ?>
    <!-- Edit & Delete Buttons (horizontal) -->
    <div class="d-flex gap-2">
        <a href="products-edited.php?id=<?= $Item['id'] ?>" class="btn btn-modern btn-edit flex-grow-1">
            <i class="fas fa-pencil-alt me-2"></i>Edit
        </a>
        <a href="products-deleted.php?id=<?= $Item['id'] ?>" class="btn btn-modern btn-delete flex-grow-1" onclick="return confirm('Are you sure to delete this product?')">
            <i class="fas fa-trash-alt me-2"></i>Delete
        </a>
    </div>
    <?php endif; ?>
</div>


<style>
    :root {
        --modern-primary: #6366f1;
        --modern-success: #22c55e;
        --modern-warning: #f59e0b;
        --modern-danger: #ef4444;
        --modern-hover: #e0e7ff;
    }

    .btn-modern {
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

/* Add to Cart button styling remains full width */
.btn-modern:not(.btn-delete):not(.btn-edit) {
    min-width: 120px;
    justify-content: center;
}

/* Edit & Delete buttons share equal width horizontally */
.btn-edit, .btn-delete {
    min-width: 0; /* Remove forced width */
    justify-content: center;
}

    .btn-modern:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .btn-modern:active {
        transform: translateY(0);
    }

    .btn-order {
        background: var(--modern-warning);
        color: white;
    }

    .btn-cart {
        background: var(--modern-primary);
        color: white;
    }

    .btn-edit {
        background: var(--modern-success);
        color: white;
    }

    .btn-delete {
        background: var(--modern-danger);
        color: white;
    }

    .btn-modern:hover {
        opacity: 0.9;
    }

    .btn-modern i {
        font-size: 0.9em;
    }

    @media (max-width: 768px) {
        .d-flex.flex-wrap {
            gap: 8px !important;
        }
        
        .btn-modern {
            flex: 1 1 48%;
            font-size: 0.8rem;
            padding: 8px 12px;
        }
        
        .btn-modern i {
            margin-right: 4px !important;
        }
    }
</style>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php 
            } else {
                echo '<h4 class="mb-0">No Records Found</h4>';
            }
            ?>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
  $('.add-to-cart-btn').click(function(e){
    e.preventDefault();

    let button = $(this);
    button.html('<i class="fas fa-spinner fa-spin me-2"></i> Adding...');
    
    let variantID = $(this).data('product-variant');
    let quantity = 1;

    $.ajax({
      type: 'POST',
      url: 'orders-code.php',
      data: {
        additem: true,
        product_id: variantID,
        quantity: quantity
      },
      dataType: 'json',
      success: function(response){
        button.html('<i class="fas fa-cart-plus me-2"></i> Add to Cart');

        if (response.status === 'success') {
          $('#cart-count').text(response.cartCount); // ✅ Update count based on server
        }

        alert(response.message); // You can replace with toast/snackbar
      },
      error: function(xhr, status, error) {
        console.error("AJAX Error:", error);
        button.html('<i class="fas fa-cart-plus me-2"></i> Add to Cart');
        alert("Something went wrong. Please try again.");
      }
    });
  });
});
</script>



<?php include('includes/footer.php'); ?>