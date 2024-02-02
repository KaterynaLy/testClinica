<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $nombre_empresa = $_POST["nombre_empresa"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $proteccion_datos = isset($_POST["proteccion_datos"]) ? "Sí" : "No";

    // Destinatarios predeterminados
    $destinatarios = array(
        "dental-malaga.com",
        "katerynalysenkocurras@gmail.com",
    );

    $asunto = "Nuevo formulario de contacto";

    $mensaje = "Nombre y Apellido: $nombre\n";
    $mensaje .= "Nombre de la empresa/asociación/colectivo: $nombre_empresa\n";
    $mensaje .= "Email de contacto: $email\n";
    $mensaje .= "Teléfono de contacto: $telefono\n";
    $mensaje .= "Acepto la política de protección de datos: $proteccion_datos\n";

    // Headers para el correo
    $headers = "From: $email" . "\r\n" .
        "Reply-To: $email" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    // Enviar el correo a todos los destinatarios
    foreach ($destinatarios as $destinatario) {
        mail($destinatario, $asunto, $mensaje, $headers);
    }

    // Redirigir o mostrar un mensaje de éxito
    header("Location: gracias.html");
    exit();
}
