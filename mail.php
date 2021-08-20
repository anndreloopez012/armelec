
<?php
//$to = "andrelopez012@gmail.com";
//$Modulo = "Laboratorio";
//$Orden = "222222";
//$titulo = "Orden de laboratorio";
//$lugar ="hospital geneeral";

$subject = $Modulo."-".$Orden;

$message = "
<html>
<head>
</head style='background-color: coral;'>
<body>
<p>$titulo</p></br></br>
<table>
<tr>
<td>$lugar</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <armelec.info@gmail.com>' . "\r\n";
//$headers .= 'Cc: <monterrosow@yahoo.com> ' . "\r\n";

//$from_mail = "dor.servicios@visualmed.online";
//			$host = "mail.privateemail.com";
//			$username  = "dor.servicios@visualmed.online";
//			$userpass  = "D0r.53rv1c1052020";
//			$port = "465";

//php mailer 

mail($to,$subject,$message,$headers);
?>