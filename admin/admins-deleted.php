<?php

require '../config/function.php';


$paraResultId= ($_GET['id']);
echo $paraResultId;

if(is_numeric($paraResultId)){
     
    $adminId= validate($paraResultId);
    $admin= getById('admins',$adminId);
    if($admin['status']==200){

        $adminDeleteRes= delete('admins',$adminId);
        if($adminDeleteRes){
            redirect('admins.php','Admin Deleted successfully');

        }

    }else{



        redirect('admins.php',$admin['message']);

    }
    
}else{
    redirect('admins.php','Something is wrong');
}




if(isset($_GET['id'])){
    if($_GET['id'] !=''){

        $adminId=$_GET['id'];

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