<?php include('includes/header.php'); ?>

<style>
    /* POS-specific styling */
    .card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    
    .card-header {
        background: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .form-control, .form-select {
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 8px 12px;
        height: 40px;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    }
    
    .btn-primary {
        background: #4361ee;
        border: none;
        padding: 8px 20px;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        background: #3a56e0;
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(67, 97, 238, 0.3);
    }
    
    .form-label {
        font-weight: 500;
        font-size: 14px;
        margin-bottom: 6px;
        color: #444;
    }
    
    .form-section {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .checkbox-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .status-label {
        margin-bottom: 0;
        font-size: 14px;
    }
</style>

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Add New Product</h4>
            <a href="categories.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="code.php" method="POST" enctype="multipart/form-data">
                <div class="form-section">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Product Category</label>
                            <select name="category_id" id="category" class="form-select">
                                <option value="">Select category</option>
                                <?php          
                                $categories = getAll('categories');
                                if($categories) {
                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $cateItem) {
                                            echo '<option value="' . $cateItem['id'] . '">' . $cateItem['name'] . '</option>';
                                        }
                                    }
                                } else {
                                    echo '<option value="">No categories found</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" name="name" id="name" required class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label"> Cost ($)</label>
                            <input type="text" name="cost" id="cost" required class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="2"></textarea>
                        </div>
                         
                    </div>

                    
                </div>

                <div class="form-section">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="text" name="price" id="price" required class="form-control">
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="text" name="quantity" id="quantity" required class="form-control">
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="checkbox-container">
                                <input type="checkbox" name="status" id="status" style="width: 20px; height: 20px;">
                                <label for="status" class="status-label">Hide product (Hidden products won't show in POS)</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3 text-end">
                            <button type="submit" name="saveProduct" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i> Save Product
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>