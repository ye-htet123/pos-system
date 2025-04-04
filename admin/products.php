<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            
            <h4 class="mb-0">
                <a href="index.php" class="btn btn-primary float-end"> <<  </a>
            </h4>
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-0">Products</h4>
                </div>

                <div class="col-md-8">
                    <form action="#" method="GET">
                        <div class="row g-1">

                            <div class="col-md-4">
                                <select name="category" id="" class="form-select">
                                    <option value="">Select Category</option>

                                    <?php
                                    // Fetch categories from the database
                                    $query = "SELECT * FROM categories"; // Assuming 'categories' is your table
                                    $result = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $category_id = $row['id']; // Assuming 'id' is the category ID
                                            $category_name = $row['name']; // Assuming 'name' is the category name

                                            // Check if this category is selected
                                            $selected = (isset($_GET['category']) && $_GET['category'] == $category_id) ? 'selected="selected"' : '';

                                            // Output the option element
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
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="card-body">
            <?php alertMessage(); ?>

            <?php 
            // Default query to get all products
            $query = "SELECT * FROM products";

            // Check if a category filter is applied
            if (isset($_GET['category']) && $_GET['category'] != '') {
                $category_id = mysqli_real_escape_string($conn, $_GET['category']);
                // Update query to filter products by the selected category ID
                $query = "SELECT * FROM products WHERE category_id='$category_id'";
            }

            $products = mysqli_query($conn, $query);

            if (!$products) {
                echo '<h4>Something went wrong.</h4>';
                return false;
            }

            if (mysqli_num_rows($products) > 0) {
            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Order</th>


                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;
                        foreach($products as $Item): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td>
                                <img src="../<?= $Item['image']; ?>" style="width:80px;height:70px;" alt="Img">
                            </td>
                            <td><?= $Item['name'] ?></td>
                            <td>
                                <?php 
                                if ($Item['status'] == 1) {
                                    echo '<span class="badge bg-danger">Hidden</span>';
                                } else {
                                    echo '<span class="badge bg-success">Visible</span>';
                                }
                                ?>
                            </td>
                            <td>
                            <a href="orders-created.php?id=<?= $Item['id']; ?> && name=<?= $Item['name']; ?>" class="btn btn-warning btn-sm">Order now</a>


                            </td>
                            <td>
                                <a href="products-edited.php?id=<?= $Item['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="products-deleted.php?id=<?= $Item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this product?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php 
            } else {
                echo '<h4 class="mb-0">No Records Found</h4>';
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
