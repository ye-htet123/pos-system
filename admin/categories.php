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
    }
    
    .card-header h4 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0;
        display: flex;
        align-items: center;
    }

    .btn-home {
        background: linear-gradient(135deg, #4cc9f0, #3a86ff);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .btn-home:hover {
        background: linear-gradient(135deg, #3a86ff, #4cc9f0);
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        color: white;
    }

    .table-container {
        padding: 1.5rem;
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

    .badge {
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 20px;
    }

    .badge-success {
        background: var(--success);
        color: white;
    }

    .badge-danger {
        background: var(--danger);
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-success {
        background: var(--success);
        color: white;
        border: none;
    }
    
    .btn-success:hover {
        background: #3aafd9;
        transform: translateY(-2px);
        color: white;
    }
    
    .btn-danger {
        background: var(--danger);
        color: white;
        border: none;
    }
    
    .btn-danger:hover {
        background: #d32f2f;
        transform: translateY(-2px);
        color: white;
    }
    
    .btn-view {
        background: var(--primary);
        color: white;
        border: none;
    }
    
    .btn-view:hover {
        background: var(--secondary);
        transform: translateY(-2px);
        color: white;
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

    @media (max-width: 768px) {
        
        .table-responsive {
            overflow-x: auto;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 0.3rem;
            font-size: 0.5rem;
        }
        
        .btn-sm {
            width: 100%;
            justify-content: center;

        }
        .btn-danger {
            font-size: 0.5rem;
        }
        .btn-view {
            font-size: 0.5rem;
        }
        .btn-success {
            font-size: 0.5rem;
        }

        .card-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
            font-size: 0.8rem;
        }
        
        .btn-home {
            margin-top: 0.5rem;
            width: 100%;
            justify-content: center;
            font-size: 0.6rem;
            width: 1.7rem;

        }
        .table th, .table td {
            padding: 0.3rem;
            font-size: 0.7rem;
        }
        
    }
</style>

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-layer-group me-3 fa-lg"></i>
                    <h4 class="mb-0 table_header">Categories Management</h4>
                </div>
                <a href="index.php" class="btn btn-home">
                    <i class="fas fa-home me-2"></i> 
                </a>
            </div>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <?php       
            $categories = getAll('categories');
            if(!$categories) {
                echo '<h4>Something went wrong</h4>';
                return false;
            }
            if(mysqli_num_rows($categories) > 0) {
            ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach($categories as $item) :
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td class="fw-bold"><?= $item['name'] ?></td>
                                <td>
                                    <?php 
                                    if($item['status'] == 1) {
                                        echo'<span class="badge badge-danger">Hidden</span>';
                                    } else {
                                        echo'<span class="badge badge-success">Visible</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="categories-edited.php?id=<?= $item['id']?>" class="btn btn-success btn-sm">
                                            Edit
                                        </a>
                                        <a href="categories-deleted.php?id=<?= $item['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this category?')">
                                            Delete
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <a href="products.php?category=<?= $item['id']?>" class="btn btn-view btn-sm">
                                        Show Products
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php 
            } else {
            ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h5>No Categories Found</h5>
                    <p class="text-muted">You haven't created any categories yet</p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>