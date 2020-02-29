<?php
 require 'class/class.phpmailer.php';

try {


		$error='';
			//Sets the 
		$mail = new PHPMailer;
		$mail->IsSMTP();					//Sets Mailer to send message using SMTP
		$mail->Host = 'smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
		$mail->Port = '587';				//Sets the default SMTP server port

		$mail->SMTPAuth = true;				//Sets SMTP authentication. Utilizes the Username and Password variables
		$mail->Username = 'k.c.s.reddy0537@gmail.com';					//Sets SMTP username
		$mail->Password = '8008832803';					//Sets SMTP password
		$mail->SMTPSecure = 'tls';							//Sets connection prefix. Options are "", "ssl" or "tls"
		$mail->From = 'k.c.s.reddy0537@gmail.com';						//Sets the From email address for the message
		$mail->FromName = 'Chandu';				 //Sets the From name of the message

		$mail->AddAddress($to,'Chandu');				//Adds a "To" address
		$mail->AddReplyTo('k.c.s.reddy0537@gmail.com', 'System Generated Email');
		//$mail->AddCC($addcc,$addccName);


		$mail->WordWrap = 50;			//Sets word wrapping on the body ofthe message to agiven number of characters
		$mail->IsHTML(true);							//Sets message type to HTML				
		$mail->Subject = 'test email';				//Sets the Subject of the message
		$mail->Body =  'you are registered successfully';		
		if($mail->Send())								//Send an Email. Return true on success or false on error
		{
			$error = '<label class="text-success">Thank you for contacting us</label>';
		}
		else
		{
			$error = $mail->ErrorInfo;
		}
		echo $error;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}