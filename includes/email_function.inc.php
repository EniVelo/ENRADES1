<?php
function send_password_reset_email($email, $resetLink) {
    $subject = "Password Reset Request";
    $message = "Hello,\n\nClick the following link to reset your password:\n\n" . $resetLink . "\n\nThis link will expire in 1 hour.";
    $headers = "From: no-reply@enrades.com";

    mail($email, $subject, $message, $headers);
}
