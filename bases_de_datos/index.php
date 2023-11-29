<?php
include_once "config.php";
include_once "database.php";
include_once "controller/registroController.php";

$registroController=new registroController();

// Ruteo de la aplicación
if ($_GET['url'] == 'registro') {
  $registroController->index();
};
if ($_GET['url'] == 'fichaRegistroNuevo') {

    header("location:http://localhost/bases_de_datos/Vista/fichaRegistro.php");
};
if ($_GET['url'] == 'nuevoRegistro') {
    $registroController->nuevoRegistro();
};



// Otras rutas y controladores


?>


