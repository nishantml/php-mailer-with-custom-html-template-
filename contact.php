<?php
// this is client mailer code ---------------------------------
require 'Config.php';
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['subject']) && isset($_POST['message'])) {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $client_subject = $_POST['subject'];
    $message = $_POST['message'];

    $subject = "Contact Support";
    $adminName = "Admin";
    $body = file_get_contents('mailer_templates/email_skeleton.html');
    $body = str_replace("{EMAIL_BODY_TEMPLATE}", file_get_contents('mailer_templates/client_contact_us.html'), $body);
    $body = str_replace("[[NAME]]", $name, $body);
    $attachment = "";
    include_once 'mailer.php';
    $mailerResponse = sendMail(array($email), array(), array(), array($name), $subject,
        $body, $attachment, Config::$SMTP_SERVER, Config::$SMTP_USERNAME,
        Config::$SMTP_PASSWORD, Config::$DEFAULT_SENDER_EMAIL, Config::$DEFAULT_SENDER_NAME,
        Config::$DEFAULT_SENDER_EMAIL, Config::$DEFAULT_SENDER_NAME);
    if ($mailerResponse) {
        $adminMailerResponse = clientMail($name, $email, $mobile, $client_subject, $message);
        if ($adminMailerResponse) {
            print_r(array('status'=>1,'msg'=> "Mail send successful "));
        } else {
            print_r(array('status'=>0,'msg'=> "Mail not send "));
        }
    } else {
        print_r(array('status'=>0,'msg'=> "Mail not send "));
    }

} else {
    print_r(array('status'=>0,'msg'=> "Please provide complete data"));
}

function clientMail($name, $email, $mobile, $client_subject, $message)
{
    $subject = "New client query";
    $adminName = "Admin";
    $body = file_get_contents('mailer_templates/email_skeleton.html');
    $body = str_replace("{EMAIL_BODY_TEMPLATE}", file_get_contents('mailer_templates/admin_contact_mailer_template.html'), $body);
    $body = str_replace("[[NAME]]", $name, $body);
    $body = str_replace("[[EMAIL]]", $email, $body);
    $body = str_replace("[[MOBILE]]", $mobile, $body);
    $body = str_replace("[[MESSAGE]]", $client_subject, $body);
    $body = str_replace("[[SUBJECT]]", $message, $body);
    $attachment = "";
    include_once 'mailer.php';
    $mailerResponse = sendMail(Config::$ADMIN_EMAIL, array(), array(), Config::$ADMIN_NAME, $subject,
        $body, $attachment, Config::$SMTP_SERVER, Config::$SMTP_USERNAME,
        Config::$SMTP_PASSWORD, Config::$DEFAULT_SENDER_EMAIL, Config::$DEFAULT_SENDER_NAME,
        Config::$DEFAULT_SENDER_EMAIL, Config::$DEFAULT_SENDER_NAME);

    return $mailerResponse;

}

?>