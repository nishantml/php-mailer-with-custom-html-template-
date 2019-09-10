<?php
//display error like in localhost
/* error_reporting(E_ALL);
ini_set('display_errors', 1);*/

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
// require 'vendor/autoload.php';

//path from index of API
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/SMTP.php';

/**
 *   This function is used to send email;
 *   $to is an array
 */

function sendMail($recipientEmail = array(), $recipientCCEmail = array(), $recipientBCCEmail = array(), $recipientName = array(), $subject, $body, $attachments = array(), $smtpServer,
                  $smtpUsername, $smtpPassword, $senderEmail,
                  $senderName = '', $senderReplyToEmail, $senderReplyToName = '') {

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
//        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $smtpServer;   // Specify main and backup SMTP servers

        $mail->SMTPAuth = true;                               // Enable SMTP authentication

        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;

        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        // $mail->Port = 587;                                    // TCP port to connect to
        $mail->Port = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($senderEmail, $senderName);
        for ($i = 0; $i < count($recipientEmail); $i++) {
            $mail->addAddress($recipientEmail[$i], isset($recipientName[$i]) ? $recipientName[$i] : ''); // Name is optional $mail->addAddress('email', 'name');
        }

        if (is_array($recipientCCEmail))
            for ($i = 0; $i < count($recipientCCEmail); $i++) {
                if ($recipientCCEmail[$i] != '')
                    $mail->addCC($recipientCCEmail[$i]); // Name is optional $mail->addAddress('email', 'name');
            }
        if (is_array($recipientBCCEmail))
            for ($i = 0; $i < count($recipientBCCEmail); $i++) {
                if ($recipientBCCEmail[$i] != '')
                    $mail->addBCC($recipientEmail[$i]); // Name is optional $mail->addAddress('email', 'name');
            }
        if (is_array($senderReplyToEmail))
            for ($i = 0; $i < count($senderReplyToEmail); $i++) {
                if ($senderReplyToEmail[$i] != '')
                    $mail->addReplyTo($senderReplyToEmail, $senderReplyToName);
            }
//         $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        if (is_array($attachments)) {
            foreach ($attachments as $attachment) {
                if ($attachment != '')
                    $mail->addAttachment($attachment, basename($attachment));
            }
        }
        $mail->AltBody = strip_tags($mail->Body);   // in case if the client does not support html

        $mail->send();
//         echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
//        echo 'Message could not be sent.';
//        echo 'Mailer Error: ' . $mail->ErrorInfo;
        return false;
    }
}
?>