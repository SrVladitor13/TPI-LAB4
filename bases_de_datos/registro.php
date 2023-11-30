<?php
// Conexión a la base de datos
include_once "config.php";

try {
    // Crear una instancia de PDO utilizando la configuración del archivo config.php
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener todos los pacientes
    $stmt = $conn->prepare("SELECT * FROM registro");
    $stmt->execute();
    $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Manejo de errores de conexión o consulta
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pacientes</title>
    <!-- Integración de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="container">
        <h1>Lista de Pacientes</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Obra Social</th>
                    <th>Fecha de Ingreso</th>
                    <!-- Agregar más columnas según los datos que quieras mostrar -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pacientes as $paciente) : ?>
                    <tr>
                        <td><?= $paciente['dni']; ?></td>
                        <td><?= $paciente['nombre']; ?></td>
                        <td><?= $paciente['apellido']; ?></td>
                        <td><?= $paciente['telefono']; ?></td>
                        <td><?= $paciente['fechaNacimiento']; ?></td>
                        <td><?= $paciente['obraSocial']; ?></td>
                        <td><?= $paciente['fechaIngreso']; ?></td>

                        <td>
                            <button class="btn btn-primary" onclick="editarPaciente(<?= $paciente['dni']; ?>)">Editar</button>
                            <a href="eliminar.php?dni=<?= $paciente['dni']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Integración de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        function editarPaciente(dni) {
            // Redirigir a la página de edición con el DNI del paciente
            window.location.href = `editar.php?dni=${dni}`;
        }
    </script>
</body>
</html>

