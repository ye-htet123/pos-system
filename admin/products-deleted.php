<?php

require '../config/function.php';


$paraResultId=($_GET['id']);
echo $paraResultId;

if(is_numeric($paraResultId)){
     
    $productId= validate($paraResultId);
    $product= getById('products',$productId);
    if($product['status']==200){

        $response= delete('products',$productId);
        if($response){
            $deleteImage="../".$productData['data']['image'];
            if(file_exists($deleteImage)){
                unlink($deleteImage);

            }
            redirect('products.php','Product Deleted successfully');

        }

    }else{



        redirect('products.php',$product['message']);

    }
    
}else{
    redirect('products.php','Something is wrong');
}



if(isset($_GET['id'])){
    if($_GET['id'] !=''){

        $productId=$_GET['id'];

    }else{
        echo'<h5>No Id found</h5>';
        return false;
    }

}
else{
    echo'<h5>No Id in given params</h5>';
    return false;
}

?>