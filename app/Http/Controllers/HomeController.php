<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PhpMailer;

class HomeController extends Controller
{

    public function index()
    {

      //Mail functionality

      $mail = new \PHPMailer(true); // notice the \  you have to use root namespace here
try {

  //Create a new PHPMailer instance
  //DON'T TOUCH THESE -----
  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->SMTPDebug = 0;
  $mail->Debugoutput = 'html';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPAuth = true;
  // ---------|

  //Mail Configuration ---------
  // MAKE CHANGES TO THIS

  $config = array(
    'username' => "al.theatrekingdom@gmail.com", //some gmail username
    'password' => "TheatreKingdom0_",
    'mail_from' => "noreply@aayaamlabs.com",
    'mail_from_name' => "Priyanshu",
    'mail_to' => "gokuney@gmail.com",
    'mail_to_name' => "Priyanshu",
    'subject' => "This is a subject",
    'body' => 'I AM MESSAGE BODY',//Umm.... try not to change the body :p

    "failure_message" => "An error occured in sending mail, please try again.",
    "success_message" => "Thanks, we will get back to you real soon."
  );



  //----- /Mail Configuration


  $mail->Username = $config["username"];
  //Password to use for SMTP authentication
  $mail->Password = $config["password"];
  //Set who the message is to be sent from
  $mail->setFrom( $config["mail_from"] , $config["mail_from_name"] );
  //Set an alternative reply-to address
  $mail->addReplyTo( 'raju_gupta@aayaamlabs.com'  , 'Raju' );
  //Set who the message is to be sent to
  $mail->addAddress($config["mail_to"], $config["mail_to_name"] );
  //Set the subject line
  $mail->Subject = $config["subject"];
  $mail->msgHTML( $config["body"] );
  //Replace the plain text body with one created manually
  $mail->AltBody = $config["body"];

  //send the message, check for errors
  if (!$mail->send()) {
    //$mail->ErrorInfo //use this to debug
      echo json_encode( array( "_status" => false , "message" => $config["failure_message"] ) );
  } else {
      echo json_encode( array( "_status" => true , "message" => $config["success_message"] ) );
  }

} catch (phpmailerException $e) {
dd($e);
} catch (Exception $e) {
dd($e);
}
        die('success');
        return;
    }
}
