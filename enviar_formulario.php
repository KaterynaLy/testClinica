<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate and sanitize inputs
    $nombre = isset($_POST["nombre"]) ? htmlspecialchars($_POST["nombre"]) : "";
    $nombre_empresa = isset($_POST["nombre_empresa"]) ? htmlspecialchars($_POST["nombre_empresa"]) : "";
    $email = isset($_POST["email"]) ? filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) : "";
    $telefono = isset($_POST["telefono"]) ? htmlspecialchars($_POST["telefono"]) : "";
    $proteccion_datos = isset($_POST["proteccion_datos"]) ? "Sí" : "No";

    // Check if required fields are empty
    if (empty($nombre) || empty($email)) {
        // Handle the error, e.g., redirect to an error page or show an error message
        die("Error: Name and Email are required fields");
    }

    // Destinatarios predeterminados
    $destinatarios = array(
        "info@dental-malaga.com", "clinicagp@gmail.com", "katerynalysenkocurras@gmail.com"
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
        if (!mail($destinatario, $asunto, $mensaje, $headers)) {
            // Handle the error, e.g., log the error or show an error message
            die("Error sending email");
        }
    }

    // Redirigir o mostrar un mensaje de éxito
    header("Location: /gracias.html");
    exit();
}
?>
