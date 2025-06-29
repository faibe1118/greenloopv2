<?php

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh; // Database handler
    private $stmt; // Statement handler
    private $error;

    // Constructor: se conecta a la base de datos
    public function __construct() {
        // Data Source Name (DSN)
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        // Intentar la conexión
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            // En caso de error de conexión, mostrar mensaje
            $this->error = $e->getMessage();
            echo "Error de conexión: " . $this->error;
        }
    }

    // Query: prepara y ejecuta una consulta SQL
    public function query($sql, $params = []) {
        $this->stmt = $this->dbh->prepare($sql); // Prepara la consulta SQL
        return $this->stmt->execute($params); // Ejecuta la consulta con los parámetros
    }

    // Fetch: devuelve una sola fila del resultado
    public function fetch() {
        return $this->stmt->fetch(PDO::FETCH_ASSOC); // Obtiene una fila como array asociativo
    }

    // FetchAll: devuelve todas las filas del resultado
    public function fetchAll() {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC); // Obtiene todas las filas
    }

    // Obtener el último ID insertado
    public function lastInsertId() {
        return $this->dbh->lastInsertId(); // Devuelve el último ID insertado
    }

    // Get the error message if there is an issue
    public function getError() {
        return $this->error;
    }

    public function rowCount() {
        return $this->stmt->rowCount();
    }

}
