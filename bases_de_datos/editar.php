<?php
include_once "config.php";

// Verificar si se envió un formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $obraSocial = $_POST['obraSocial'];
        $fechaIngreso = $_POST['fechaIngreso'];

        $updateStmt = $conn->prepare("UPDATE registro
            SET nombre = :nombre, apellido = :apellido, telefono = :telefono, fechaNacimiento = :fechaNacimiento, obraSocial = :obraSocial, fechaIngreso = :fechaIngreso 
            WHERE dni = :dni");

        $updateStmt->bindParam(':dni', $dni);
        $updateStmt->bindParam(':nombre', $nombre);
        $updateStmt->bindParam(':apellido', $apellido);
        $updateStmt->bindParam(':telefono', $telefono);
        $updateStmt->bindParam(':fechaNacimiento', $fechaNacimiento);
        $updateStmt->bindParam(':obraSocial', $obraSocial);
        $updateStmt->bindParam(':fechaIngreso', $fechaIngreso);

        $updateStmt->execute();

        if ($updateStmt->rowCount() > 0) {
            header("Location: registro.php"); // Redirigir a registro.php después de editar
            exit();
        }
    } catch (PDOException $e) {
        echo "Error al actualizar: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}

// Obtener los datos del paciente a editar
if (isset($_GET['dni'])) {
    try {
        $dni = $_GET['dni'];
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT * FROM registro WHERE dni = :dni");
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
        
        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener los datos del paciente: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Paciente</title>
    <!-- Integración de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Editar Paciente</h1>
        <form method="post" style="margin-top: 20px;">
            <!-- Input fields para editar los datos -->
            <div class="input-group mb-3">
            <input type="hidden" name="dni" class="form-control" value="<?= $paciente['dni']; ?>">
            </div>
            <div class="input-group mb-3">
            <input type="text" name="nombre" class="form-control" value="<?= $paciente['nombre']; ?>">
            </div>
            <div class="input-group mb-3">
            <input type="text" name="apellido" class="form-control" value="<?= $paciente['apellido']; ?>">
            </div>
            <div class="input-group mb-3">
            <input type="text" name="telefono" class="form-control" value="<?= $paciente['telefono']; ?>">
            </div>
            <div class="input-group mb-3">
            <input type="date" name="fechaNacimiento" class="form-control" value="<?= $paciente['fechaNacimiento']; ?>">
            </div>
            <div class="input-group mb-3">
            <input type="text" name="obraSocial" class="form-control" value="<?= $paciente['obraSocial']; ?>">
            </div>
            <div class="input-group mb-3">
            <input type="date" name="fechaIngreso" class="form-control" value="<?= $paciente['fechaIngreso']; ?>">
            </div>
            <button type="submit" class="btn btn-primary mt-3" name="submit">Guardar</button>
        </form>
    </div>
    <!-- Integración de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

