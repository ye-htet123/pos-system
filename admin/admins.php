<?php include('includes/header.php');?>


<div class="container-fluid px-4">

<div class="card mt-4 shadow-sm">
 
<div class="card-header">
    <h4 class="mb-0">Admin/Staff
        <a href="admins-created.php" class="btn btn-primary float-end">Add Admin</a>
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
                    <th>Email</th>
                    <th>Phone no</th>


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
                <td><?= $adminItem['email']?></td>
                <td><?= $adminItem['phone']?></td>
                <td><?= $adminItem['created_at']?></td>


                <td>
                    <?php 
                    if($adminItem['is_ban']== 1) {
                        echo'<span class="badge bg-danger">Banned</span>';
                    }else{
                        echo'<span class="badge bg-success">Active</span>';

                    }
                        ?>
                        </td>
                        <td>
                    <a href="admins-edited.php?id=<?=  $adminItem['id']?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="admins-deleted.php?id=<?=  $adminItem['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this admin?')">Delete</a>
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





















