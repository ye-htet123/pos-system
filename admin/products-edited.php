<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Product</h4>
            <a href="products.php" class="btn btn-primary float-end">Back</a>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="code.php" method="POST" enctype="multipart/form-data">
                <?php       
                $paramValue= checkParamId('id');
                if(!is_numeric($paramValue)){
                    echo '<h5>Id is not an integer</h5>';
                    return false;
                }
                $product=getById('products', $paramValue);
                if($product){
                    if($product['status']==200){

                   

                ?>
                <input type="hidden" name="product_id" value="<?=  $product['data']['id']    ;?>">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select name="category_id" id="category" class="form-select">
                            <option value="">Select category</option>
                            <?php          
                            $categories = getAll('categories');
                            if($categories){
                            if ($categories && mysqli_num_rows($categories) > 0) {
                                foreach ($categories as $cateItem) {
                                    ?>
                                    <option 
                                    value=" <?= $cateItem['id']; ?> "
                                     <?= $product['data']['category_id'] == $cateItem['id'] ? 'selected':''; ?>
                                     >
                                     <?= $cateItem['name']; ?>
                                    </option>
                                        <?php
                                }
                            }else{
                                echo '<option value=""> No Categories found</option>';
                            }

                        }
                        else{
                            echo '<option value=""> Something is wrong</option>';

                        }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="name"> Product Name</label>
                        <input type="text" name="name" id="name" value="<?= $product['data']['name'];?>" required class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"><?= $product['data']['description'];?></textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="price"> Product Price</label>
                        <input type="text" name="price"  id="price" value="<?= $product['data']['price'];?>" required class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="quantity"> Product Quantity</label>
                        <input type="text" name="quantity" id="quantity" required value="<?= $product['data']['quantity'];?>" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="image"> Product Image</label>
                        <input type="file" name="image" id="image" required  class="form-control"  >
                        <img src="../<?= $product['data']['image'];?> " alt="img" style="width:40px;height:40px;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status">Status (Unchecked = Visible, Checked = Hidden)</label>
                        <br>
                        <input type="checkbox" name="status" id="status"  <?= $product['data']['status'] ? 'checked':''?> style="width: 30px; height: 30px;">
                    </div>

                    <div class="col-md-6 mb-3 text-end">
                        <br>
                        <button type="submit" name="updateProduct" class="btn btn-primary">Update</button>
                    </div>
                </div>
                <?php  
                }else{
                    echo '<h5>'.$product['message'].'</h5>';
                }
                
                }else{
                echo '<h5>Something is wrong</h5>';
                return false;
                }

                ?>

            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
