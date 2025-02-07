<?php

require '../config/function.php';


$paraResultId=checkParamId('id');
echo $paraResultId;

if(is_numeric($paraResultId)){
     
    $customerId= validate($paraResultId);
    $customer= getById('customers',$customerId);
    if($customer['status']==200){

        $response= delete('customers',$customerId);
        if($response){
            redirect('customers.php','Customer  Deleted successfully');

        }

    }else{



        redirect('customers.php',$customer['message']);

    }
    
}else{
    redirect('customers.php','Something is wrong');
}



if(isset($_GET['id'])){
    if($_GET['id'] !=''){

        $customerId=$_GET['id'];

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