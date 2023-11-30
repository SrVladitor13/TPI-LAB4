<?php

class registroController {
    public function index() {
        include_once __DIR__ . '/../Vista/database.php';
        $db = new Database();
        $c = $db->conectar();

        // Consulta de ejemplo para obtener información de registro
        $stmt = $c->prepare('SELECT * FROM registro ');
        $stmt->execute();
        $registro = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include "../Vista/registro.php";
    }

    public function nuevoRegistro() {
        include_once __DIR__ . '/../Vista/database.php';
        $db = new Database();
        $c = $db->conectar();

        try {
            // Obtener datos del formulario
            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $telefono = $_POST['telefono'];
            $fechaNacimiento = $_POST['fechaNacimiento'];
            $obraSocial = $_POST['obraSocial'];
            $fechaIngreso = date("Y-m-d H:i:s");

            // Consulta de ejemplo para agregar un nuevo registro
            $stmt = $c->prepare(
                "INSERT INTO registro (dni, nombre, apellido, telefono, fechaNacimiento, obraSocial, fechaIngreso) " .
                "VALUES (:dni, :nombre, :apellido, :telefono, :fechaNacimiento, :obraSocial, :fechaIngreso)"
            );

            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
            $stmt->bindParam(':obraSocial', $obraSocial);
            $stmt->bindParam(':fechaIngreso', $fechaIngreso);

            $stmt->execute();

            header("location:http://localhost/tpi-lab4/bases_de_datos/index.php?url=registro");
        } catch(PDOException $e) {
            echo "Error al insertar paciente: " . $e->getMessage();
        } finally {
            $db = null;
        }
    }
}
?>
