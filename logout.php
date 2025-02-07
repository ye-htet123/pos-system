<?php

require 'config/function.php';
if(isset($_SESSION['loggedIn'])){
    

    logOutSession();
    redirect('login.php','Logged Out Successfully.');
}else {
    // If the user is not logged in, redirect them to the login page with an appropriate message
    redirect('login.php', 'You are not logged in.');
}



?>