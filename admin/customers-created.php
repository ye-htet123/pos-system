<?php include('includes/header.php');?>

<style>
    /* Center card and limit max width */
    .custom-card-container {
        max-width: 600px;  /* max width of the card */
        margin: 50px auto; /* center horizontally with margin */
        padding: 0 15px;   /* small horizontal padding */
    }

    /* Make card full width on small screens */
    @media (max-width: 640px) {
        .custom-card-container {
            max-width: 100%;
            margin: 10px 10px;
            padding: 0 10px;
        }
    }
</style>

<div class="container-fluid custom-card-container px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Add Customers</h4>
            <a href="customers.php" class="btn btn-primary float-end">Back</a>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="code.php" method="POST">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" required class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" required class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Phone</label>
                        <input type="number" name="phone" required class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="">Status (UnChecked=Visible, Checked=Hidden)</label>
                        <br>
                        <input type="checkbox" name="status" style="width:30px;height:30px;">
                    </div>

                    <div class="col-md-6 mb-3 text-end">
                        <br>
                        <button type="submit" name="saveCustomer" class="btn btn-primary">Save</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
