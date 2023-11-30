<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = ""; // La contraseña de tu base de datos
    private $dbname = "registro"; // Nombre de tu base de datos
    private $conn;

    public function conectar() {
        try {
            // Crear una instancia de PDO utilizando los datos del archivo config.php
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e) {
            // Manejo de errores de conexión
            echo "Error de conexión: " . $e->getMessage();
            return null; // en caso de error
        }
    }

}
?>

