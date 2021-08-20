<?php
$mail = new PHPMailer(true);
try {
	$mail->SMTPDebug = 0;
	$mail->isSMTP();
	$mail->Host       = 'mail.privateemail.com';
	$mail->SMTPAuth   = true;
	$mail->Username   = 'dor.contacto@visualmed.online';
	$mail->Password   = 'D0r.C0ntact02020';
	$mail->SMTPSecure = 'TLS';
	$mail->Port       =  587;
	$mail->setFrom('dor.contacto@visualmed.online', 'VisualMed');
	$subject  = $subject_;
	$address  = $address_;
	$mail->addAddress($address, $subject);
	$mail->addAddress('andrelopez012@gmail.com', 'andre');
	$mail->isHTML(true);
	$mail->Subject = $subject;
	$mail->Body    = $mailContent;
	$mail->CharSet = 'UTF-8';

	$mail->send();
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
