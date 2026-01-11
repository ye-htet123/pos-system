<?php
include('config/dbcon.php');
include('config/function.php');

if(isset($_GET['name'])) {
    $customerName = validate($_GET['name']);
    if($customerName != '') {
        $query = "SELECT * FROM customers WHERE name LIKE '%$customerName%'";
        $result = mysqli_query($conn, $query);
    } else {
        $result = getAll('customers');
    }
} else {
    $result = getAll('customers');
}
?>

<div class="p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0"><i class="fas fa-users me-2"></i> Customers</h5>
        <form class="d-flex" method="GET" action="customers-popup.php" onsubmit="loadCustomers(event)">
            <input type="text" class="form-control me-2" name="name" placeholder="Search name" value="<?= isset($_GET['name']) ? $_GET['name'] : '' ; ?>">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            <button class="btn btn-danger ms-2" type="button" onclick="loadCustomers()">Reset</button>
        </form>
    </div>

    <?php if($result && mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($result as $Item): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $Item['name']; ?></td>
                        <td><?= $Item['email']; ?></td>
                        <td><?= $Item['phone']; ?></td>
                        <td>
                            <?php if($Item['status'] == 1): ?>
                                <span class="badge bg-danger">Hidden</span>
                            <?php else: ?>
                                <span class="badge bg-success">Visible</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-success selectCustomerBtn" 
                                data-name="<?= $Item['name']; ?>" 
                                data-phone="<?= $Item['phone']; ?>">
                                <i class="fas fa-check me-1"></i> Select
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="text-center py-4 text-muted">
            <i class="fas fa-user-slash fa-2x mb-3"></i>
            <h6>No Records Found</h6>
        </div>
    <?php endif; ?>
</div>

<script>
// Reload customers list dynamically
function loadCustomers(event) {
    if (event) event.preventDefault();
    const form = event ? event.target : null;
    let query = form ? new URLSearchParams(new FormData(form)).toString() : '';
    fetch('customers-popup.php' + (query ? '?' + query : ''))
        .then(res => res.text())
        .then(data => {
            document.getElementById('customerModalContent').innerHTML = data;
        });
}

// Select customer and fill phone input
document.querySelectorAll('.selectCustomerBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        const phone = this.dataset.phone;
        document.getElementById('cphone').value = phone;
        const modal = bootstrap.Modal.getInstance(document.getElementById('customerPopupModal'));
        modal.hide();
    });
});
</script>

