<?php
include 'database.php';

$email = $_GET['email'];

$stmt = $con->prepare("SELECT full_name,password from users where email = ?");
$stmt->bindParam(1, $email, PDO::PARAM_STR);
// $stmt->bindParam(2, $password, PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount() > 0)
{
	while ($row = $stmt->fetchObject()) 
	{
        $to = $email;
        $subject = 'Forgot Password - MYPocketLawyer';
        $message = "
        <html><body>
        <p>Hi there ".$row->full_name.",</p>
        <p>Your MYPocketLawyer password is: ".$row->password."</p>
        <p>Thank you for using MYPocketLawyer</p></body></html>";
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers
        $headers .= 'From: <support@mypocketlawyer.com>' . "\r\n";
        // $headers .= 'Cc: umarfarooqyt@gmail.com' . "\r\n";
        
        if((mail($to,$subject,$message,$headers)))
        {
            $response['error'] = 0;
            $response['message'] = "Email Sent Succesfully."; 
            echo json_encode($response);
        }
        else{
            $response['error'] = 1;
            $response['message'] = "Unable to send password reset email to ".$email; 
            echo json_encode($response);
        }

	   
	   
	   
	   
	   
	}
}
else{
    $response['error'] = 1;
    $response['message'] = "User not found."; 
    echo json_encode($response);
}







// ini_set("include_path", '/home/mypocketlawyer/php:' . ini_get("include_path") );
// require_once "Mail.php";

// $from = '<support@mypocketlawyer>'; //change this to your email address
// $to = '<umarfarooq571@gmail.com>'; // change to address
// $subject = 'Insert subject here'; // subject of mail
// $body = "Hello world! this is the content of the email"; //content of mail

// $headers = array(
//     'From' => $from,
//     'To' => $to,
//     'Subject' => $subject
// );

// $smtp = Mail::factory('smtp', array(
//         'host' => 'mail.mypocketlawyer.com',
//         'port' => '465',
//         'auth' => true,
//         'username' => 'support@mypocketlawyer.com', //your gmail account
//         'password' => 'Wgfukyb(?{bY' // your password
//     ));


// $mail = $smtp->send($to, $headers, $body);


// if (PEAR::isError($mail)) {
//     echo '<p>'.$mail->getMessage().'</p>';
// } else {
//     echo '<p>Message successfully sent!</p>';
// }

?>