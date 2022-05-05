<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "composer/vendor/autoload.php";
$cambio = new cambioClave($_GET["correoI"]);
$cambio->crear();
$mail = new PHPMailer();
$mail->CharSet = 'UTF-8';
$mail->IsSMTP();
$mail->SMTPDebug = 2;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->Username = "maramirezm@correo.udistrital.edu.co";
$mail->Password = "****";
$mail->SetFrom('maramirezm@correo.udistrital.edu.co', 'MARIA ALEJANDRA RAMIREZ MONTENEGRO');
$mail->AddReplyTo("montenegroaleja65@gmail.com", "Aleja Montenegro");
$mail->Subject = "CAMBIO DE CONTRASEÑA";
$mail->MsgHTML("Hola, " . $_GET["nombre"] . "<br><br>Ha solicitado un cambio de contraseña.<br><br>Por favor hacer click en el link para cambiar tu contraseña.<br>" . 'https://pgsistemadegestionacademico.online/index.php?pid=' . base64_encode("presentacion/cambiarContrasena.php") . "<br><br>Cordial saludo,<br><b>MARIA ALEJANDRA RAMIREZ MONTENEGRO</b>");
$address = $_GET["correoI"];

$mail->AddAddress($address);
try {
    $mail->send();
    echo "<script>window.location = 'index.php';</script>";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}

?>