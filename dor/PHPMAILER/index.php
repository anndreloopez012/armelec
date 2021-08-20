<?php

//$mailName = 'visualMed';
//$subject_ = 'VisualMed';
//$address_  = "andrelopez012@gmail.com";
//$mailContent = '
//<h2>nombre</h2>
//<p>usuario</p>
//<p>pass</p>';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';


$mail = new PHPMailer(true);

try {
	//Server settings
	$mail->SMTPDebug = 0;
	$mail->isSMTP();
	$mail->Host       = 'mail.privateemail.com';
	$mail->SMTPAuth   = true;
	$mail->Username   = 'gut.contacto@visualmed.online';
	$mail->Password   = 'Gut.C0ntact02020';
	$mail->SMTPSecure = 'TLS';
	$mail->Port       =  587;

	//si existe adjunto
	//if ($ad) {
	//	//añadimos texto al nombre original del archivo
	//	$dir_subida = 'fichero_';
	//	//nombre del fichero creado -> fichero_nombreArchivo.pdf
	//	$fichero_ok = $dir_subida . basename($ad);
	//	//y lo subimos a la misma carpeta
	//	move_uploaded_file($_FILES['adjunto']['tmp_name'], $fichero_ok);
	//}

	//Recipients
	$mail->setFrom('gut.contacto@visualmed.online', 'VisualMed');
	$subject  = $subject_;
	$address  = $address_;
	$mail->addAddress($address, $subject);
	$mail->addAddress('monterrosow@gmail.com', 'monterrosow');
	$mail->addAddress('andrelopez012@gmail.com', 'andre');
	$mail->addAddress('gut.contacto@visualmed.online', 'contacto');
	//$mail->addReplyTo('andrelopez012p@gmail.com');
	//$mail->addCC('cc@example.com'); xxxxxxxxxxxxx
	//$mail->addBCC('bcc@example.com');

	// Attachments
	//$mail->addAttachment($fichero_ok);         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	// Content
	$mail->isHTML(true);
	$mail->Subject = $subject;
	$mail->Body    = $mailContent;
	$mail->CharSet = 'UTF-8';

	$mail->send();
} catch (Exception $e) {
	echo "El mensaje no se pudo enviar. Mailer Error: {$mail->ErrorInfo}";
}
