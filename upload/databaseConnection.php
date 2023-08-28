<?php

class DatabaseConnection {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "test";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Ошибка соединения: " . $this->conn->connect_error);
        }
    }

    public function executeQuery($query) {
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }

        $result = null;
        if ($stmt->execute()) {
            $result = $stmt->get_result();
        } else {
            die("Ошибка выполнения запроса: " . $stmt->error);
        }

        $stmt->close();
        return $result;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

?>
