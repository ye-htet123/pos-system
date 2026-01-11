<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function send_reset_email($to_email, $reset_link) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
         $mail->Username   = 'yhtetaung235@gmail.com'; // Your email
        $mail->Password   = 'ypsbsmwthrvtbrke';        // App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('yhtetaung235@gmail.com', 'Your App Name');
        $mail->addAddress($to_email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $mail->Body = "Click to reset your password: <a href='$reset_link'>$reset_link</a> your password is blalbla";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
?>