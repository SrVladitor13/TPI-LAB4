<?php
include_once "database.php"; // Asegúrate de incluir el archivo de la clase Database

// Crear una instancia de la clase Database
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['dni'])) {
    try {
        // Conectarse a la base de datos
        $conn = $db->conectar();

        // Obtener el DNI del paciente desde el GET
        $dni = $_GET['dni'];

        // Consulta para eliminar el paciente con el DNI específico
        $sql = "DELETE FROM registro WHERE dni = ?";
        $q = $conn->prepare($sql);
        $q->execute(array($dni));

        // Redirigir a la página principal (o donde sea necesario)
        header("Location: registro.php");
        exit();
    } catch (PDOException $e) {
        // Manejo de errores de conexión o consulta
        echo "Error al eliminar paciente: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Eliminar Registro de Paciente</h3>
                    </div>
                    <form class="form-horizontal" action="eliminar.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">¿Querés borrar este paciente?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Si</button>
                          <a class="btn" href="index.php">No</a>
                        </div>
                    </form>
                </div>

    </div>
  </body>
</html>