<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Add Product</h4>
            <a href="categories.php" class="btn btn-primary float-end">Back</a>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="code.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select name="category_id" id="category" class="form-select">
                            <option value="">Select category</option>
                            <?php          
                            $categories = getAll('categories');
                            if($categories){
                            if ($categories && mysqli_num_rows($categories) > 0) {
                                foreach ($categories as $cateItem) {
                                    echo '<option value="' . $cateItem['id'] . '">' . $cateItem['name'] . '</option>';
                                }
                            }
                        }else {
                            echo '<option value=""> Something is wrong</option>';

                            
                        }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="name"> Product Name</label>
                        <input type="text" name="name" id="name" required class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="price"> Product Price</label>
                        <input type="text" name="price" id="price" required class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="quantity"> Product Quantity</label>
                        <input type="text" name="quantity" id="quantity" required class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="image"> Product Image</label>
                        <input type="file" name="image" id="image" required class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status">Status (Unchecked = Visible, Checked = Hidden)</label>
                        <br>
                        <input type="checkbox" name="status" id="status" style="width: 30px; height: 30px;">
                    </div>

                    <div class="col-md-6 mb-3 text-end">
                        <br>
                        <button type="submit" name="saveProduct" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
