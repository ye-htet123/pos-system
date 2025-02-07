<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">

    <div class="card mt-4 shadow-sm">
    
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Left: Header -->
                <h4 class="mb-0">Customers</h4>
                
                <!-- Middle: Filter box -->
                <div class="col-md-6">
                    <form action="#" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="name" placeholder="search with name"
                            value="<?= isset($_GET['name']) ? $_GET['name'] : '' ; ?>">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            <a href="customers.php" class="btn btn-danger">Reset</a>
                        </div>
                    </form>
                </div>

                <!-- Right: Back Button -->
                <a href="index.php" class="btn btn-primary"><<</a>
            </div>
        </div>

        <div class="card-body">
            <?php alertMessage(); ?>
            <?php 
            if(isset($_GET['name'])) {
                $customerName = validate($_GET['name']);
                
                // If a name is provided, search for customers with that name
                if($customerName != '') {
                    $query = "SELECT * FROM customers WHERE name LIKE '%$customerName%'";
                    $result = mysqli_query($conn, $query);
                } else {
                    // If no name is provided, fetch all customers
                    $result = getAll('customers');
                }
            } else {
                // Fetch all customers if no search is done
                $result = getAll('customers');
            }

            if($result && mysqli_num_rows($result) > 0) {
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach($result as $Item):
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $Item['name']; ?></td>
                                <td><?= $Item['email']; ?></td>
                                <td><?= $Item['phone']; ?></td>
                                <td>
                                    <?php 
                                    if($Item['status'] == 1) {
                                        echo '<span class="badge bg-danger">Hidden</span>';
                                    } else {
                                        echo '<span class="badge bg-success">Visible</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="customers-edited.php?id=<?= $Item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="customers-deleted.php?id=<?= $Item['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this customer?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
            } else {
                // Display if no customers are found
                echo '<h4 class="mb-0 text-center">No Records Found</h4>';
            }
            ?>
        </div>
    </div>
    
    <?php include('includes/footer.php'); ?>
</div>
