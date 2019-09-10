# php-mailer-with-custom-html-template

### This repo contains php mailer with custom html mailer templates where you can customize or design your mailer templates using html and css  

This repo contains two directories 
1. mailer templates : This directory contain mailer templates 
2. phpmailer : This contains core php mailers lib

Now coming to core code
1. config.php file contains all cred details corresponding to mailer 
    ```
    public static $SMTP_SERVER = 'cs8.webhostbox.net'; //  smtp host name
    public static $SMTP_USERNAME = 'developer@devmins.com';  // sending mailer email id should be there.
    public static $SMTP_PASSWORD = 'xyx';  // sending mailer email id password should be there.
    public static $ROOT_DOMAIN = "";
    
    public static $ADMIN_EMAIL = array("admin@devmins.com");  // admin email where client query will be recieved. In this you can pass multiple admin email id who you want to recieve new client query ex : array("admin@devmins.com","admin2@devmins.com");
    
    public static $ADMIN_NAME = array("Nishant");  // admin name where client query will be recieved. same as above you can pass multiple admin name corresponding to admin email id
    public static $DEFAULT_SENDER_EMAIL = 'developer@devmins.com';  // sending mailer email id should be there.
    public static $DEFAULT_SENDER_NAME = 'Team '; // this will be the name of the sender 
    ```
    
    
2. mailer.php file. This file contains sendMail function where we are passing paramenter coresponding to mailer.
  ```
    function sendMail($recipientEmail = array(), $recipientCCEmail = array(), $recipientBCCEmail = array(), $recipientName = array(), $subject, $body, $attachments = array(), $smtpServer,
                      $smtpUsername, $smtpPassword, $senderEmail,
                      $senderName = '', $senderReplyToEmail, $senderReplyToName = '') 
  ```
3. contact.php file. This is the file where we have to hit with data 
    ```
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $client_subject = $_POST['subject'];
    $message = $_POST['message'];
    ```
In this file we are sending mail to the contacted client and also to the admin let me show you how and what.

- Sample request using postman
<img src="https://devmins.com/correct_response.PNG"/>

- Client contact form response mailer template
<img src="https://devmins.com/response.PNG"/>

- Admin mailer template
<img src="https://devmins.com/admin.PNG"/>


Step to be follow 
1. edit config.php file and addon your email cred from which you want to send 
2. you have to hit on contact.php with data 

And thats it. 

> You are done 
