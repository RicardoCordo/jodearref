<?php

header("Access-Control-Allow-Origin: *");
if ($_POST)	{

    $name = $_POST['name'];
	$from = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];



	// set response code - 200 OK

	http_response_code(200);
	$subject = "Nuevo mensaje de formulario de contacto.";
	$to = "jodearrefrigeracion@gmail.com";

	// data

	$msg = $name . ' escribió: ' . $message;

	// Headers

	$headers = "MIME-Version: 1.0\r\n";
	$headers.= "Content-type: text/html; charset=UTF-8\r\n";
	$headers.= "From: <" . $from . ">";
	
	$result = mail($to, $subject, $msg, $headers);


    if($result) {
        header('Location: https://jodear.com.ar/gracias');
    }
      else
	{

    header('Location: http://jodear.com.ar/gracias');
	
	}

}
	

?>