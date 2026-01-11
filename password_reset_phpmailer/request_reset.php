<?php
require '../config/dbcon.php';        // DB connection
require 'send_email.php';            // Email function

// Set timezone
date_default_timezone_set('Asia/Yangon');

// Custom alert function
function showAlert($message, $type = 'success', $redirectUrl = '') {
    $colors = [
        'success' => ['#d4edda', '#155724', '#c3e6cb'],
        'warning' => ['#fff3cd', '#856404', '#ffeeba'],
        'danger'  => ['#f8d7da', '#721c24', '#f5c6cb']
    ];

    list($bg, $text, $border) = $colors[$type];

     // For "success", redirect to Gmail
    $button = ($type === 'success') ?
        "<button onclick=\"window.location.href='https://mail.google.com/'\" 
            style='padding: 6px 14px; background-color: $text; color: white; border: none; border-radius: 5px; cursor: pointer;'>
            OK
        </button>"
        : ($type === 'danger' ?
        "<button onclick=\"window.location.href='$redirectUrl'\" 
            style='padding: 6px 14px; background-color: $text; color: white; border: none; border-radius: 5px; cursor: pointer;'>
            Cancel
        </button>"
        :
        "<button onclick=\"document.getElementById('customAlert').style.display='none'\" 
            style='padding: 6px 14px; background-color: $text; color: white; border: none; border-radius: 5px; cursor: pointer;'>
            OK
        </button>"
    );

    echo "
    <div id='customAlert' style='
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        margin-top: 20px;
        padding: 15px 25px 20px 25px;
        background-color: $bg;
        color: $text;
        border: 1px solid $border;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        z-index: 9999;
        animation: dropDown 0.4s ease-out;
        text-align: center;
        min-width: 300px;
    '>
        <div style='margin-bottom: 10px;'>$message</div>
        $button
    </div>

    <style>
    @keyframes dropDown {
        from { opacity: 0; transform: translate(-50%, -30px); }
        to { opacity: 1; transform: translate(-50%, 0); }
    }
    </style>
    ";
    exit;
}

// --- Form Submission ---
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check for valid user
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        showAlert("❌ No user found with that email address.", "danger", "reset_form.html");
    }

    // Create token and expiry
    $token = bin2hex(random_bytes(32));
    $expiry = date("Y-m-d H:i:s", strtotime("+15 minutes"));

    $update = $conn->prepare("UPDATE admins SET reset_token = ?, token_expiry = ? WHERE email = ?");
    $update->bind_param("sss", $token, $expiry, $email);
    
    if (!$update->execute()) {
        showAlert("⚠️ Failed to update reset token.", "warning");
    }

    // Create reset link
    $reset_link = "http://localhost:8080/pos/password_reset_phpmailer/reset_password.php?token=$token";

    // Send email
    if (send_reset_email($email, $reset_link)) {
        showAlert("✅ A password reset link has been sent to your email.", "success");
    } else {
        showAlert("⚠️ Email failed to send. Please try again.", "warning");
    }
}
?>
