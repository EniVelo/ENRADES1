<?php
require_once 'dbh.inc.php';
require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

   
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(50));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

      
        $stmt = $pdo->prepare("UPDATE users SET reset_token=?, token_expiry=? WHERE email=?");
        $stmt->execute([$token, $expiry, $email]);

        $resetLink = "http://localhost/ENRADES/reset_password.php?token=$token";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->Username = 'emailiyt@gmail.com'; 
            $mail->Password = 'fjalekalimi-i-aplikacionit';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('emailiyt@gmail.com', 'ENRADES');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Rikuperimi i fjalëkalimit';
            $mail->Body    = "Kliko <a href='$resetLink'>këtu</a> për të vendosur një fjalëkalim të ri. Linku skadon për 1 orë.";

            $mail->send();
            echo "Emaili për rikuperim u dërgua me sukses.";
        } catch (Exception $e) {
            echo "Dërgimi i emailit dështoi. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Ky email nuk ekziston.";
    }
}
?>
