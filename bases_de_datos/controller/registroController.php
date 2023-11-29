<?php

final class registroController
{
    function index()
    {
        $db = new database();
        $c = $db->conectar();

        // Consulta de ejemplo para obtener información de registro
        $stmt = $c->prepare('SELECT * FROM registro '); //WHERE fechaNacimiento BETWEEN "1992/01/01" and "1993/01/01"
        $stmt->execute();
        $registro = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include "Vista/registro.php";
        $db = null;
    }

    function nuevoRegistro()
    {
        $db = new database();
        $c = $db->conectar();
        //var_dump($_POST);
        // Consulta de ejemplo para agregar un nuevo registro
        $stmt = $c->prepare(
            " INSERT INTO registro ( dni, nombre, apellido, telefono, fechaNacimiento, modeloAuto, patente, fechaPase)" .
                " VALUES   ('" . $_POST['dni'] . "', '" . $_POST['nombre'] . "', '" . $_POST['apellido'] . "', '" . $_POST['telefono'] . "', '" . $_POST['fechaNacimiento'] . "', '" . $_POST['modeloAuto'] . "', '" . $_POST['patente'] . "', '" . date("Y-m-d H:i:s") . "') "
        );

        //$stmt = $c->prepare(
        //    " INSERT INTO pacientes ( dni, nombre, apellido, direccion, telefono, email, fechaNacimiento, obraSocialId)" .
        //        " VALUES   ('" . $_POST['dni'] . "', '" . $_POST['nombre'] . "', '" . $_POST['apellido'] . "', '" . $_POST['direccion'] . "', '" . $_POST['telefono'] . "', '" . $_POST['email'] . "', '" . $_POST['fechaNac'] . "', 1) "
        //);

        $stmt->execute();
        $db = null;
        header("location:http://localhost/bases_de_datos/index.php?url=registro");
    }
}
