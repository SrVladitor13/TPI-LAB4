<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo paciente</title>
    <!-- Integración de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Nuevo Paciente</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <!-- Acción al mismo archivo PHP -->
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni">
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono">
            </div>
            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento">
            </div>
            <div class="mb-3">
                <label for="modeloAuto" class="form-label">Obra Social</label>
                <input type="text" class="form-control" id="obraSocial" name="obraSocial">
            </div>
            <div class="mb-3">
                <label for="fechaPase" class="form-label">Fecha de Ingreso</label>
                <input type="date" class="form-control" id="fechaIngreso" name="fechaIngreso">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Guardar</button>
        </form>
        </div>
        </form>

        <?php
include_once "config.php"; // Incluye el archivo de configuración

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    try {
        // Crear una instancia de PDO utilizando la configuración del archivo config.php
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recibe los datos del formulario
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $obraSocial = $_POST['obraSocial'];
        $fechaIngreso = $_POST['fechaIngreso'];

        // Consulta para verificar si el paciente ya existe
        $stmt = $conn->prepare("SELECT * FROM registro WHERE dni = :dni");
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // El paciente ya existe, por lo que actualizamos sus datos
            $updateStmt = $conn->prepare("UPDATE registro
                SET nombre = :nombre, apellido = :apellido, telefono = :telefono, fechaNacimiento = :fechaNacimiento, obraSocial = :obraSocial, fechaIngreso = :fechaIngreso 
                WHERE dni = :dni");

            // Asignar los valores para actualizar
            $updateStmt->bindParam(':dni', $dni);
            $updateStmt->bindParam(':nombre', $nombre);
            $updateStmt->bindParam(':apellido', $apellido);
            $updateStmt->bindParam(':telefono', $telefono);
            $updateStmt->bindParam(':fechaNacimiento', $fechaNacimiento);
            $updateStmt->bindParam(':obraSocial', $obraSocial);
            $updateStmt->bindParam(':fechaIngreso', $fechaIngreso);

            // Ejecutar la consulta de actualización
            $updateStmt->execute();

        } else {
            // El paciente no existe, por lo que lo insertamos
            $insertStmt = $conn->prepare("INSERT INTO registro (dni, nombre, apellido, telefono, fechaNacimiento, obraSocial, fechaIngreso)
                                        VALUES (:dni, :nombre, :apellido, :telefono, :fechaNacimiento, :obraSocial, :fechaIngreso)");

            // Asignar los valores para insertar
            $insertStmt->bindParam(':dni', $dni);
            $insertStmt->bindParam(':nombre', $nombre);
            $insertStmt->bindParam(':apellido', $apellido);
            $insertStmt->bindParam(':telefono', $telefono);
            $insertStmt->bindParam(':fechaNacimiento', $fechaNacimiento);
            $insertStmt->bindParam(':obraSocial', $obraSocial);
            $insertStmt->bindParam(':fechaIngreso', $fechaIngreso);

            // Ejecutar la consulta de inserción
            $insertStmt->execute();

            if ($insertStmt->rowCount() > 0) {
                header("Location: registro.php");
                echo "<p>¡Paciente registrado exitosamente!</p>";
                exit();
            }

        }
    } catch (PDOException $e) {
        // Manejo de errores de conexión o consulta
        echo "Error al insertar paciente: " . $e->getMessage();
    } finally {
        // Cerrar la conexión
        $conn = null;
    }
}
?>

    </div>
    <!-- Integración de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
