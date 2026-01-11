<?php include('includes/header.php');?>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        color: #343a40;
    }

    .card {
        border-radius: 0px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        background: linear-gradient(45deg, #007bff, #b30900ff);
        color: white;
        border-radius: 0px;
        padding: 1rem;
    }

    .card-header h4 {
        margin-bottom: 0;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    /* Custom badge colors */
    .bg-ban {
        color: #dc3545;             /* red text */
        border: 1px solid #dc3545;
    }

    .bg-active {
        color: #418719ff;             /* green text */
        border: 1px solid #198754;
    }
    .btn-admin{
        background: linear-gradient(45deg, #007bff, #b30900ff);
         border-color: #d6d9ddff;
    }
    .fa-user-plus{
        color: rgba(4, 36, 77, 1);
    }
    .fa-user-plus:hover{
        color: rgba(140, 166, 200, 1);
    }
    
    @media (max-width: 768px){
        .table th, .table td {
            padding: 0.1rem;
            font-size: 0.7rem;
        }
        .btn-edit {
            font-size: 0.5rem;
        }
        .btn-delete {
            font-size: 0.5rem;
        }

    }
</style>


<div class="container-fluid px-4">

<div class="card mt-4 shadow-sm">
 
<div class="card-header">
    <h4 class="mb-0">Admin/Staff
        <a href="admins-created.php" class="btn btn-admin float-end">
            <i class="fas fa-user-plus"></i>
        </a>
    </h4>
</div>
<div class="cardbody">
<?php alertMessage();?>
<?php 
           $admin=getAll('admins');
           if(!$admin){
            echo '<h4>something is wrong"</h4>';
            return false;
           }
           if(mysqli_num_rows($admin)>0){
            ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th class="d-none d-md-table-cell">Email</th>
                    <th>Phone no</th>
                    <th>Created at</th> 

                    <th>Action</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>


            <?php
             $i=1;
           foreach($admin as $adminItem):
           
            ?>
           
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $adminItem['name']?></td>
                <td class="d-none d-md-table-cell"><?= $adminItem['email']?></td>
                <td><?= $adminItem['phone']?></td>
                <td><?= $adminItem['created_at']?></td>


                <td>
                    <?php 
                    if($adminItem['is_ban']== 1) {
                        echo'<span class="badge bg-ban">Banned</span>';
                    }else{
                        echo'<span class="badge bg-active">Active</span>';

                    }
                        ?>
                        </td>
                        <td>
                    <a href="admins-edited.php?id=<?= $adminItem['id'] ?>" class="btn btn-edit btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="admins-deleted.php?id=<?= $adminItem['id'] ?>" class="btn btn-delete btn-sm" 
                    onclick="return confirm('Are you sure to delete this admin?')">
                        <i class="fas fa-trash"></i>
                    </a>

                </td>
            </tr>
            <?php 
            endforeach;}
            else{

            
                ?>
                <tr>
                    <h4 class="mb-0">No Record found</h4>
                </tr>

            <?php }?>
            </tbody>
        </table>
    </div>
</div>
</div>
<?php include('includes/footer.php');?>

</div>





















