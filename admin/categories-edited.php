<?php include('includes/header.php');?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Category</h4>
            <a href="categories.php" class="btn btn-primary float-end">Back</a>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="code.php" method="POST">


            <?php
             $paramValue=checkParamId('id');
            if(!is_numeric($paramValue)){
                echo '<h5>'.$paramValue.'</h5>';
                return false;
            }
            $category =getById('categories', $paramValue);
            if($category['status']== 200){

            
               ?>
               <input type="hidden"  name="categoryId"value="<?= $category['data']['id'];?>">

                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name"  value="<?= $category['data']['name'];?>" required class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" row="3"><?= $category['data']['description']?></textarea>
                    </div>
                    <div class="col-md-6">
                    <label for="">Status (UnChecked=Visible, Checked=Hidden)</label>
                    <br>
                    <input type="checkbox" name="status" style="width:30px;height:30px;">
                    </div>
                   

                    <div class="col-md-6 mb-3 text-end">
                        <br>
                        <button type="submit" name="updateCategory" class="btn btn-primary">Update </button>
                    </div>

                </div>

                <?php     
            }
            else{
                echo '<h5>'.$category['message'].'</h5>';

            }
                
                ?>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
