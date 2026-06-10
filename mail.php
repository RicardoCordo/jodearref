<?php

header("Access-Control-Allow-Origin: *");

if ($_POST) {

    $name    = $_POST['name'];
    $from    = $_POST['email'];
    $phone   = $_POST['phone'];
    $message = $_POST['message'];

    $to      = "jodearrefrigeracion@gmail.com";
    $subject = "Nueva consulta desde jodear.com.ar";

    $msg = "
    <html>
    <body>
        <h2>Nueva consulta desde la web</h2>

        <p><strong>Nombre:</strong> {$name}</p>
        <p><strong>Email:</strong> {$from}</p>
        <p><strong>Teléfono:</strong> {$phone}</p>

        <p><strong>Mensaje:</strong></p>
        <p>{$message}</p>
    </body>
    </html>
    ";

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";

    // Remitente REAL de tu dominio
    $headers .= "From: Jodear Refrigeración <info@jodear.com.ar>\r\n";

    // Cuando respondas el mail, responderá al cliente
    $headers .= "Reply-To: {$from}\r\n";

    $result = mail($to, $subject, $msg, $headers);

    if ($result) {
        header('Location: https://jodear.com.ar/gracias');
        exit;
    } else {
        echo "Error al enviar el correo.";
    }
}
?>