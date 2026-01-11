<?php
require '../config/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];

    echo "Submitted token: " . htmlspecialchars($token) . "<br>";

    $stmt = $conn->prepare("SELECT * FROM admins WHERE reset_token = ? AND token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        echo "Token matched. Resetting password...<br>";

        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE admins SET password = ?, reset_token = NULL, token_expiry = NULL WHERE reset_token = ?");
        $update->bind_param("ss", $hashed, $token);
        $update->execute();

        echo "Password has been reset. You can now <a href='../login.php'>login</a>.";
    } else {
        echo "Invalid or expired token.";
    }
}
?>
