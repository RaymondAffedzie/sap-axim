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
    $mail->setFrom('support@paultimothyleadershipnetwork.org', 'Paul Timothy Leadership Network');
    $mail->addAddress($email);     
    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Password Reset';
    $mail->Body    = '<h1 style="font-family: monospace, san-serif; text-align: center; margin-bottom: 20px;">Need a new password?</h1>
                        <p style="font-family: monospace, san-serif; text-align: center;">
                        No worries. Use the verification code and choose a new one.<br>
                        Verification code: '.$resetcode.'</p>    
                        <p style="font-family: monospace, san-serif; text-align: center;">
                            You did not request this change? You can ignore this email and get back to business as usual.
                        </p>';
    $mail->send();
?>