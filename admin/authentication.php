<?php
// session_start();
// require '../config/function.php';

// Function to log out session + clear cookie + clear DB token
// function logOutSession() {
//     global $conn;

//     if (isset($_SESSION['loggedInUser']['email'])) {
//         $email = $_SESSION['loggedInUser']['email'];
//         $stmt = $conn->prepare("UPDATE admins SET remember_token=NULL WHERE email=?");
//         $stmt->bind_param("s", $email);
//         $stmt->execute();
//     }

//     // destroy session
//     session_unset();
//     session_destroy();

//     // clear cookie
//     setcookie("remember_token", "", time() - 3600, "/");
// }

// ✅ Step 1: If not logged in, try Remember Me cookie
if (!isset($_SESSION['loggedIn']) && isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE remember_token=? LIMIT 1");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // set session same as login.php
        $_SESSION['loggedIn'] = true;
        $_SESSION['loggedInUser'] = [
            'user_id' => $row['id'],
            'name'    => $row['name'],
            'email'   => $row['email'],
            'phone'   => $row['phone']
        ];
    }
}

// ✅ Step 2: If still not logged in → force back
if (!isset($_SESSION['loggedIn'])) {
    redirect('../login.php', 'Login to continue...');
    exit();
}

// ✅ Step 3: Verify user in DB
$email = validate($_SESSION['loggedInUser']['email']);
$query = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    logOutSession();
    redirect('../login.php', 'Login to continue...');
    exit();
}

$row = mysqli_fetch_assoc($result);

// ✅ Step 4: Check if banned
if ($row['is_ban'] == 1) {
    logOutSession();
    redirect('../login.php', 'Your account has been banned! Contact your admin.');
    exit();
}
