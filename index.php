<?php 

include_once './PHPMailer/src/PHPMailer.php';
include_once './PHPMailer/src/SMTP.php';
include_once './PHPMailer/src/Exception.php';
//Namespaces
    use PHPMailer\PHPMailer\PHPMailer;   
    use PHPMailer\PHPMailer\SMTP;   
    use PHPMailer\PHPMailer\Exception;
//Create Instance
$email = $_POST['email'];
$mail = new PHPMailer();
$mail->isSMTP();
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->SMTPAuth = true;
$mail->Username = 'bakti12356@gmail.com';
$mail->Password = 'xizqhtwwrlslhhbq';
$mail->isHTML(true);
$mail->setFrom('noreply@radarbjm.com', 'Radar Banjarmasin');
$mail->addReplyTo($email, 'TEST');
$mail->addAddress($email, 'awokaokwaokoaw');
$mail->Subject = 'Percobaan SMTP';
ob_start();
include_once './contents.php';
$msg = ob_get_clean();
// $mail->msgHTML(file_get_contents('contents.php'), __DIR__);
$mail->Body = $msg;
$mail->AltBody = 'This is a plain-text message body';
$mail->addAttachment('./phpmailer_mini.png');

if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}
?>