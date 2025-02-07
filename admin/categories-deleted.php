<?php

require '../config/function.php';


$paraResultId=($_GET['id']);
echo $paraResultId;

if(is_numeric($paraResultId)){
     
    $categoryId= validate($paraResultId);
    $category= getById('categories',$categoryId);
    if($category['status']==200){

        $response= delete('categories',$categoryId);
        if($response){
            redirect('categories.php','Category Deleted successfully');

        }

    }else{



        redirect('categories.php',$category['message']);

    }
    
}else{
    redirect('categories.php','Something is wrong');
}



if(isset($_GET['id'])){
    if($_GET['id'] !=''){

        $categoryId=$_GET['id'];

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