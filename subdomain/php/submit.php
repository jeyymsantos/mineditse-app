<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['submit'])) {
    $user = $_POST['email'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    // $message = $_POST['message'];

    $message = '
   
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
    </head>
    
    <body>
        <p> Hi, <strong>' . $name . '!</strong></p>
    
        <p> Thank you for visiting our website and spending your time to send an email. This is to acknowledge
            that we have received your message and we will reply as soon as possible within 48 hours.
    
            <br><br>
    
            If this is urgent, you may call us directly thru <a rel="noopener" href="tel:09338104290" target="_blank">0933
                810
                4290</a> or visit our physical store at Barangay Sto. Cristo, Baliuag, Bulacan, Philippines.
    
            Thank you so much, Miners!
    
            <br><br>
            Your One-Stop Shop, <br>
            <b>Mine Ditse 😊 </b>
        </p>
    </body>
    
    </html>

    ';

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = 'true';
    $mail->Username = 'inquiry@mineditse.tech';
    $mail->Password = 'MineDitse@15';
    $mail->SMTPSecure = 'tls';
    $mail->Port = '587';

    $mail->setFrom('inquiry@mineditse.tech', 'Mine Ditse');
    $mail->addAddress($user);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->send();

    header('Location: index.html');


    // $mailto = "contact@mineditse.tech"; // our
    // $from = $_POST['email']; // sender's emai
    // $name = $_POST['name']; 
    // $subject = $_POST['subject'];
    // $subject2 = "Your message submitted successfully | Mine Ditse"; //client

    // $message = "Client Name: " . $name . "Wrote the following message" . "\n\n" . $_POST['message'];
    // $message2 = "Dear " . $name . "\n\nThank you for contacting us! We will get back to your shortly.";

    // $headers = "From: " . $from; // User Email
    // $headers2 = "From: " . $mailto; // Client

    // $result = mail($mailto, $subject, $message. $headers); // send email to webowner
    // $result2 = mail($from, $subject2, $message2, $headers2);

    // if($result) { // if email submitted successfully
    //     echo "email sent!";
    // }else{
    //     echo "email failed";
    // }
}
