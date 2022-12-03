<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    include_once('../includes/header.php');
    require_once('../PHPMailer/src/Exception.php');
    require_once('../PHPMailer/src/PHPMailer.php');
    require_once('../PHPMailer/src/SMTP.php');

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth   = true;
    $mail->Username   = 'irbbawebsdev@gmail.com';
    $mail->Password   = 'hckfnkwvocysaure';

    //Recipients
    $mail->setFrom('support@irbbawebsdev.com', 'St. Anthony of Padua Catholic Church - Axim');
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Password Reset';
    $mail->Body    = '<h1 style="font-family: monospace, san-serif; text-align: center; margin-bottom: 20px;">Need a new password?</h1>
                        <p style="font-family: monospace, san-serif; font-size: 18px; text-align: center;">
                            No worries. Use the verification code and choose a new one.<br>
                            Verification code: <b>'.$resetcode.'</b> <br>
                            You can ignore this email, if you did not request this and get back to business as usual.
                        </p>';
    $mail->send();