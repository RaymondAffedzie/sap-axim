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
    $mail->setFrom('support@paultimothyleadershipnetwork.org', 'St. Anthony of Padua Catholic Church - Axim');
    $mail->addAddress($email);     
    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Password Change Confirmation';
    date_default_timezone_set('Africa/Accra');
    $mail->Body    = '<h1 style="font-family: monospace, san-serif; text-align: center; margin-bottom: 20px;">Your password changed</h1>
                        <p style="font-family: monospace, san-serif; text-align: center;">
                        Your password for the Paul Timothy Leadership Network account '.$email.' was changed on '.date('Y-m-d').' '.date("h:i:sa").'<br></p>    
                        <p style="font-family: monospace, san-serif; text-align: center;">
                            You can safely ignore this email, if this was you and get back to business as usual.
                        </p>';
    $mail->send();
?>