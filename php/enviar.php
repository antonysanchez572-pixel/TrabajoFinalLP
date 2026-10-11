<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "antonysanchespena572@gmail.com";
    $subject = "Inscripcion SENATI: " . strip_tags($_POST['nombre'] ?? '') . " " . strip_tags($_POST['apellido'] ?? '');

    // Sanitización de entradas
    $nombre           = strip_tags($_POST['nombre'] ?? '');
    $segundo_nombre   = strip_tags($_POST['segundo_nombre'] ?? '');
    $apellido         = strip_tags($_POST['apellido'] ?? '');
    $fecha_nacimiento = strip_tags($_POST['fecha_nacimiento'] ?? '');
    $genero           = strip_tags($_POST['genero'] ?? '');
    
    $direccion_1      = strip_tags($_POST['direccion_1'] ?? '');
    $direccion_2      = strip_tags($_POST['direccion_2'] ?? '');
    $ciudad           = strip_tags($_POST['ciudad'] ?? '');
    $estado           = strip_tags($_POST['estado'] ?? '');
    $codigo_postal    = strip_tags($_POST['codigo_postal'] ?? '');
    
    $email            = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $telefono         = strip_tags($_POST['telefono'] ?? '');
    $empresa          = strip_tags($_POST['empresa'] ?? 'No especificada');
    $curso            = strip_tags($_POST['curso'] ?? '');
    $cursos_previos   = strip_tags($_POST['cursos_previos'] ?? '');
    $comentarios      = strip_tags($_POST['comentarios'] ?? 'Sin comentarios');

    // Construcción del mensaje
    $body  = "NUEVA INSCRIPCIÓN RECIBIDA - SENATI\n";
    $body .= "========================================\n\n";
    
    $body .= "[INFORMACIÓN PERSONAL]\n";
    $body .= "Alumno: $nombre $segundo_nombre $apellido\n";
    $body .= "Fecha Nacimiento: $fecha_nacimiento\n";
    $body .= "Género: $genero\n\n";

    $body .= "[DIRECCIÓN DE DOMICILIO]\n";
    $body .= "Calle L1: $direccion_1\n";
    $body .= "Calle L2: $direccion_2\n";
    $body .= "Ciudad: $ciudad | Estado/Prov: $estado | CP: $codigo_postal\n\n";

    $body .= "[INFORMACIÓN DE CONTACTO Y ACADÉMICA]\n";
    $body .= "Correo: $email\n";
    $body .= "Teléfono: $telefono\n";
    $body .= "Empresa: $empresa\n";
    $body .= "Curso Elegido: $curso\n";
    $body .= "Cursos Anteriores: $cursos_previos\n";
    $body .= "Comentarios: $comentarios\n";

    // Cabeceras
    $domain  = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'senati.local';
    $headers  = "From: no-reply@" . $domain . "\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $body, $headers)) {
        echo "exito";
    } else {
        echo "error";
    }
} else {
    header("Location: index.html");
    exit;
}
?>