<?php include('includes/header.php');?>

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
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        color: white;
        border-radius: 0 !important;
        border: none;
        padding: 1.2rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
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
        background: linear-gradient(90deg, var(--secondary), var(--primary));
        transform: translateY(-2px);
    }

    .form-control, .form-select, .form-textarea {
        border: 1px solid #e0e7ff;
        border-radius: 8px;
        padding: 0.8rem 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .form-control:focus, .form-select:focus, .form-textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        outline: none;
    }

    label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
        color: var(--dark);
    }

    .status-toggle {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1rem;
    }

    .status-text {
        font-weight: 500;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 30px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #e0e7ff;
        transition: .4s;
        border-radius: 34px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .toggle-slider {
        background-color: var(--primary);
    }

    input:checked + .toggle-slider:before {
        transform: translateX(30px);
    }

    .form-section {
        background: #f8f9ff;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-section-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .form-section-title i {
        font-size: 1.3rem;
    }
</style>

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-layer-group"></i>
                <h4 class="mb-0">Add New Category</h4>
            </div>
            <a href="categories.php" class="btn btn-light">
                <i class="fas fa-arrow-left me-1"></i> Back to Categories
            </a>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="code.php" method="POST">
                <div class="form-section">
                    <h5 class="form-section-title">
                        <i class="fas fa-info-circle"></i> Category Information
                    </h5>
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for=""><i class="fas fa-tag me-1"></i> Category Name</label>
                            <input type="text" name="name" required class="form-control" placeholder="Enter category name">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for=""><i class="fas fa-align-left me-1"></i> Description</label>
                            <textarea name="description" class="form-control form-textarea" rows="3" placeholder="Enter category description"></textarea>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="status-toggle">
                                <span class="status-text">Category Status:</span>
                                <div class="toggle-switch">
                                    <input type="checkbox" name="status" id="statusToggle">
                                    <label class="toggle-slider" for="statusToggle"></label>
                                </div>
                                <div>
                                    <span class="status-text">Hidden</span>
                                    <span class="status-text text-muted">(Unchecked = Visible, Checked = Hidden)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-end">
                    <button type="submit" name="saveCategory" class="btn btn-primary px-4 py-2">
                        <i class="fas fa-save me-1"></i> Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Update status text based on toggle
    document.addEventListener('DOMContentLoaded', function() {
        const statusToggle = document.getElementById('statusToggle');
        const statusText = document.querySelector('.status-text');
        
        statusToggle.addEventListener('change', function() {
            const statusElements = document.querySelectorAll('.status-text');
            if (this.checked) {
                statusElements[0].textContent = 'Hidden';
                statusElements[0].style.color = '';
            } else {
                statusElements[0].textContent = 'Visible';
                statusElements[0].style.color = 'var(--primary)';
            }
        });
        
        // Initialize status text
        if (!statusToggle.checked) {
            const statusElements = document.querySelectorAll('.status-text');
            statusElements[0].textContent = 'Visible';
            statusElements[0].style.color = 'var(--primary)';
        }
    });
</script>

<?php include('includes/footer.php'); ?>