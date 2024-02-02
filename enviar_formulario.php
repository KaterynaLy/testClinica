<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $nombre_empresa = $_POST["nombre_empresa"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $proteccion_datos = isset($_POST["proteccion_datos"]) ? "Sí" : "No";

    $destinatarios = array(
        "dentalagp@gmail.com",
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

    foreach ($destinatarios as $correo) {
        mail($correo, $asunto, $mensaje, $headers);
    }

    // Puedes redirigir al usuario a una página de confirmación o mostrar un mensaje de éxito aquí
    echo "¡Formulario enviado con éxito!";
} else {
    // Manejar el acceso directo al script sin enviar el formulario
    echo "Acceso no permitido";
}
?>