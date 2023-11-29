<?php

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "consultas";

try {
  // Crear una instancia de PDO
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // Configurar PDO para mostrar los errores en caso de que ocurran
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Consultas a la base de datos

  // Consulta de ejemplo para agregar un nuevo pacientes
  $stmt = $conn->prepare(
    " INSERT INTO registro ( dni, nombre, apellido, telefono, fechaNacimiento, modeloAuto, patente, fechapase)".
  " VALUES   ('147258369', 'MAMA', 'PITUFA', '36240321654987', '1991-10-10', 'Fitito', 'TUFIN4', '2020-01-01 00:00:00) ");
  $stmt->execute();


   // Consulta de ejemplo para obtener información de los pacientes
   $stmt = $conn->prepare('SELECT * FROM registro '); //WHERE fechaNacimiento BETWEEN "1992/01/01" and "1993/01/01"
   $stmt->execute();
   $registro = $stmt->fetchAll(PDO::FETCH_ASSOC);


  // Mostrar los resultados
  foreach ($registro as $reg) {
    echo "DNI: " . $reg['dni'] . "<br>";
    echo "Nombre: " . $reg['nombre'] . "<br>";
    echo "Apellido: " . $reg['apellido'] . "<br>";
    echo "Teléfono: " . $reg['telefono'] . "<br>";
    echo "Fecha de Nacimiento: " . $reg['fechaNacimiento'] . "<br>";
    echo "Modelo de Auto: " . $reg['modeloAuto'] . "<br>";
    echo "Patente: " . $reg['patente'] . "<br>";
    echo "Fecha de Pase: " . $reg['fechaPase'] . "<br>";
    echo "<br>";
  }


} catch(PDOException $e) {
  // Manejo de errores de conexión
  echo "Error de conexión: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
