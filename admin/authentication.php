<?php

if(isset($_SESSION['loggedIn'])){
    $email= validate($_SESSION['loggedInUser']['email']);
    $query= "SELECT * FROM admins WHERE email='$email' LIMIT 1";
    $result= mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 0){ 
        logOutSession();
        redirect('../login.php','Login to continue...');

    }
    else{
        $row=mysqli_fetch_assoc($result);
    if($row['is_ban']== 1){
        logOutSession();
        redirect('../login.php','your account has been banned! contact your admin.');

    }

    }
}else{

    
    redirect('../login.php','Login to continue...');
}







?>