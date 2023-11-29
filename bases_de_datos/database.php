<?php


class database
{
    
    public function conectar()
    {
        include "config.php";        
        
        try {
            // Crear una instancia de PDO
            $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Configurar PDO para mostrar los errores en caso de que ocurran
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
        } catch (PDOException $e) {
            // Manejo de errores de conexión
            echo "Error de conexión: " . $e->getMessage();
        }
    }

   
}

?>