<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>

  <?php

  echo "<table class='table table-light'>
<tbody>
<tr >
     <td>DNI</td>
     <td>Nombre</td>
     <td>Apellido</td>
     <td>Telefono</td>
     <td>Fecha de Nacimiento</td>
     <td>Modelo de Auto</td>
     <td>Patente</td>
     <td>Fecha de Pase</td>
   </tr>";

  // Mostrar los resultados
  foreach ($registro as $reg) {


    echo "
   <tr>
     <td>{$reg['dni']}</td>
     <td>{$reg['nombre']}</td>
     <td>{$reg['apellido']}</td>
     <td>{$reg['telefono']}</td>
     <td>{$reg['fechaNacimiento']}</td>
     <td>{$reg['modeloAuto']}</td>
     <td>{$reg['patente']}</td>
     <td>{$reg['fechaPase']}</td>
   </tr>

";
  }

  echo " </tbody>
</table>";


  ?>


<a href="http://localhost/bases_de_datos/index.php?url=fichaRegistroNuevo">Agregar</a>

</body>

</html>
