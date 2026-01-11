<?php

require 'config/function.php';
if(isset($_SESSION['loggedIn'])){
    if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];

    // clear token in database
    $stmt = $conn->prepare("UPDATE admins SET remember_token=NULL WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
}

    

    

    logOutSession();
    redirect('login.php','Logged Out Successfully 🎉');
    // destroy session
session_unset();
session_destroy();

// delete cookie
setcookie("remember_token", "", time() - 3600, "/");
}else {
    // If the user is not logged in, redirect them to the login page with an appropriate message
    redirect('login.php', 'You are not logged in.');
}

?>