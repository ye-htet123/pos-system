<?php include('includes/header.php');?>


<div class="container-fluid px-4">

<div class="card mt-4 shadow-sm">
 
<div class="card-header">
    <h4 class="mb-0">Categories
        <a href="index.php" class="btn btn-primary float-end"> <<  </a>
    </h4>
</div>
<div class="cardbody">
<?php alertMessage();?>
<?php       
           
           $categories=getAll('categories');
           if(!$categories){
            echo '<h4>something is wrong"</h4>';
            return false;
           }
           if(mysqli_num_rows($categories)> 0){
            ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>view</th>
              
                </tr>
            </thead>
            <tbody>


            <?php
             $i=1;
           foreach($categories as $Item):
            ?>
           
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $Item['name']?></td>
                <td>
                <?php 
                    if($Item['status']== 1) {
                        echo'<span class="badge bg-danger">Hidden</span>';
                    }else{
                        echo'<span class="badge bg-success">Visible</span>';

                    }
                        ?>
                 </td>
                <td>
                    <a href="categories-edited.php?id=<?=  $Item['id']?>" class="btn btn-success btn-sm">Edit</a>
                    <a href="categories-deleted.php?id=<?=  $Item['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this category?')">Delete</a>
                </td>
                <td>
                <a href="products.php?category=<?=  $Item['id']?>" class="btn btn-success btn-sm">show products</a>

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





