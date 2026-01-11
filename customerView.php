<?php include('includes/header.php'); ?>

<?php     
  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
  $ownerEmailSubstring = 'owner@gmail.com'; 
?>

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
        border-radius: 16px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        color: white;
        border-radius: 0 !important;
        border: none;
        padding: 1.2rem 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
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
        background: var(--danger);
        color: white;
        font-size: 14px;
        padding: 2px 8px;
        border-radius: 50%;
        font-weight: 600;
    }

    .card-img-wrapper {
        overflow: hidden;
        height: 200px;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
        background: linear-gradient(45deg, #4cc9f0, #4361ee);
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
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-modern:not(.btn-delete):not(.btn-edit) {
        min-width: 120px;
        justify-content: center;
    }

    .btn-modern:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        opacity: 0.9;
    }

    .btn-modern:active {
        transform: translateY(0);
    }

    .btn-cart {
        background: var(--primary);
        color: white;
        border: none;
    }

    .btn-edit {
        background: var(--success);
        color: white;
        border: none;
    }

    .btn-delete {
        background: var(--danger);
        color: white;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(90deg, var(--secondary), var(--primary));
        transform: translateY(-2px);
    }

    .btn-danger {
        background: var(--danger);
        border: none;
    }

    .badge {
        font-weight: 600;
        padding: 0.5rem 0.8rem;
        border-radius: 20px;
    }

    .badge.bg-warning {
        background: var(--warning) !important;
        color: var(--dark);
    }

    .badge.bg-danger {
        background: var(--danger) !important;
    }

    .badge.bg-success {
        background: var(--success) !important;
    }

    .filter-container {
        background: white;
        padding: 1rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
    }

    .page-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-title i {
        font-size: 1.8rem;
    }

    .product-card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-card .card-footer {
        background: transparent;
        border-top: none;
        padding: 0 1.5rem 1.5rem;
    }

    .product-name {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--dark);
    }

    .product-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .product-table th {
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        color: white;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
    }

    .product-table td {
        padding: 1rem;
        border-bottom: 1px solid #eee;
    }

    .product-table tr:last-child td {
        border-bottom: none;
    }

    .product-table tr:hover {
        background-color: #f8f9ff;
    }

    .product-table .product-img {
        width: 80px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #e0e7ff;
    }

    @media (max-width: 992px) {
        .product-table {
            display: block;
            overflow-x: auto;
        }
        
        .product-table th, 
        .product-table td {
            min-width: 150px;
        }
    }
</style>

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="page-title">
                        <i class="fas fa-box"></i>
                        <h4 class="mb-0">Products</h4>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="index.php" class="btn btn-light me-2">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                        
                        <?php
                        $cartCount = isset($_SESSION['productItems']) ? count($_SESSION['productItems']) : 0;
                        ?>
                        <a href="orders-created.php" class="btn btn-light position-relative me-2">
                            <i class="fas fa-shopping-cart me-1"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= $cartCount ?>
                            </span>
                        </a>
                        
                        <form action="#" method="GET" class="d-flex align-items-center ms-2">
                            <div class="me-2">
                                <select name="category" class="form-select">
                                    <option value="">All Categories</option>
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

                            <div>
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-filter me-1"></i>Filter
                                </button>
                                <a href="products.php" class="btn btn-danger">
                                    <i class="fas fa-sync-alt me-1"></i>Reset
                                </a>
                            </div>
                        </form>
                    </div>
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
                echo '<div class="alert alert-danger">Something went wrong.</div>';
                return false;
            }

            if (mysqli_num_rows($products) > 0) {
            ?>
                <div class="table-responsive">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($products as $Item): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td>
                                    <img src="../<?= $Item['image']; ?>" class="product-img" alt="Product Image">
                                </td>
                                <td>
                                    <div class="product-name"><?= $Item['name'] ?></div>
                                    <div class="text-muted small"><?= getCategoryName($Item['category_id'], $conn) ?></div>
                                </td>
                                <td>
                                    <?php 
                                    if ($Item['status'] == 1) {
                                        echo '<span class="badge bg-danger">Hidden</span>';
                                    } else {
                                        echo '<span class="badge bg-success">Visible</span>';
                                    }
                                    ?>
                                </td>
                                <td class="product-price">$<?= number_format($Item['price'], 2) ?></td>
                                <td>
                                    <?php 
                                    if ($Item['quantity'] < 1) {
                                        echo '<span class="badge bg-danger">Out of Stock</span>';
                                    } else {
                                        if ($Item['status'] == 1) {
                                            echo '<span class="badge bg-danger">Out of Stock</span>';
                                        } else {
                                            echo '<span class="badge bg-warning">' . $Item['quantity'] . ' in stock</span>';
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="submit" name="addItem" class="btn btn-modern btn-cart add-to-cart-btn" data-product-variant="<?= $Item['id']; ?>">
                                            <i class="fas fa-cart-plus me-2"></i>Add
                                        </button>

                                        <?php if (strpos($_SESSION['loggedInUser']['email'], $ownerEmailSubstring) !== false): ?>
                                        <a href="products-edited.php?id=<?= $Item['id'] ?>" class="btn btn-modern btn-edit">
                                            <i class="fas fa-pencil-alt me-2"></i>Edit
                                        </a>
                                        <a href="products-deleted.php?id=<?= $Item['id'] ?>" class="btn btn-modern btn-delete" onclick="return confirm('Are you sure to delete this product?')">
                                            <i class="fas fa-trash-alt me-2"></i>Delete
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php 
            } else {
                echo '<div class="alert alert-info text-center py-4">
                        <i class="fas fa-box-open fa-2x mb-3"></i>
                        <h4 class="mb-0">No Products Found</h4>
                      </div>';
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
    let originalText = button.html();
    button.html('<i class="fas fa-spinner fa-spin me-2"></i> Adding...');
    button.prop('disabled', true);
    
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
        button.html(originalText);
        button.prop('disabled', false);

        if (response.status === 'success') {
          // Update cart count
          $('.badge.bg-danger').text(response.cartCount);
          
          // Show success notification
          showNotification(response.message, 'success');
        } else {
          // Show error notification
          showNotification(response.message, 'danger');
        }
      },
      error: function(xhr, status, error) {
        console.error("AJAX Error:", error);
        button.html(originalText);
        button.prop('disabled', false);
        showNotification("Something went wrong. Please try again.", 'danger');
      }
    });
  });
  
  function showNotification(message, type) {
    const notification = $(`<div class="alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3" style="z-index: 9999;">
                              ${message}
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
    
    $('body').append(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
      notification.alert('close');
    }, 3000);
  }
});
</script>

<?php 
// Helper function to get category name
function getCategoryName($category_id, $conn) {
    $query = "SELECT name FROM categories WHERE id = '$category_id'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['name'];
    }
    
    return 'Uncategorized';
}
?>

<?php include('includes/footer.php'); ?>