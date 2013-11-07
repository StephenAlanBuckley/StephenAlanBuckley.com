<?php
/*This page will proces sending mail from any page that needs it!
  Things it will need:
  -eFrom (the email address that wrote this)
  -eTo (who it's going to, defaults to stephen.alan.buckley@gmail.com I think)
  -eSubject (the subject of the email)
  -eBody (the body of the email as a string)
*/

if ($_POST['sendEmail']) {
	$from = $_POST['eFrom'] == ''? 'anonymous@thisPersonGaveNoEmail.com' : $_POST['eFrom'];
	$to = $_POST['eTo'] == '' ? 'stephen.alan.buckley@gmail.com' : $_POST['eTo'];
	$subject = $_POST['eSubject'] == '' ? 'Empty Subject!' : $_POST['eSubject'];
	$body = $_POST['eBody'] == '' ? 'Empty Body?!  Come on, man!' : $_POST['eBody'];

	$body .= '<br> ' . date('l jS \of F Y h:i:s A');

	$headers = "From: $from \r\n" . 
			   "Reply-To: $from \r\n" . 
			   "X-Mailer: PHP/" . phpversion();

	mail($to, $subject, $body, $headers);
	$mail_div = '<div class="confirmed_send">';
	$mail_div .= '<p>Your Email Is On Its Way! Great Job, Internet User!</p>';
	$mail_div .= '</div>';
	echo $mail_div;
}
?>