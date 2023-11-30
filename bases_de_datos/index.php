<?php
include_once "controller/registroController.php";

if (isset($_GET['url'])) {
    if ($_GET['url'] === 'nuevo.php') {
        include_once "Vista/nuevo.php";
        exit();
    } elseif ($_GET['url'] === 'registro') {
        $registroController->index();
    } elseif ($_GET['url'] === 'fichaRegistroNuevo') {
        header("Location: http://localhost/tpi-lab4/bases_de_datos/Vista/fichaRegistro.php");
        exit();
    } elseif ($_GET['url'] === 'nuevoRegistro') {
        $registroController->nuevoRegistro();
    } else {
        echo "URL no válida";
    }
} else {
    // Mostrar la página de bienvenida por defecto
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Gestor de tareas</title>
        <!-- Integración de Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <!-- Contenido principal -->
            <h1>Bienvenido</h1>
            <!-- Enlace a nuevo.php -->
            <a href="nuevo.php" class="btn btn-primary">Agregar Nuevo Paciente</a>
        </div>
        <!-- Integración de Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
}
?>
