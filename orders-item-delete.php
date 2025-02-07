


<?php  


require 'config/function.php';
$paramResult = checkParamId('index');
if(is_numeric($paramResult)){


    $indexValue =validate($paramResult);
    if(isset($_SESSION['productItems']) && isset($_SESSION['productItemIds'])){


        unset($_SESSION['productItems'][$indexValue]);
        unset($_SESSION['productItemIds'][$indexValue]);
        redirect('orders-created.php','Item removed');



    }else{
        redirect('orders-created.php','There is no items');
        

    }
}else{
    redirect('orders-created.php','param not numeric');

}

?>