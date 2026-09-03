<?php
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

$tentativas = 10;
$pdo = null;

while ($tentativas > 0) {
    try {
        $pdo = new PDO(
            "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
            $user,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        break;
    } catch (PDOException $e) {
        $tentativas--;
        if ($tentativas === 0) {
            die('Não foi possível conectar ao banco de dados: ' . $e->getMessage());
        }
        sleep(2);
    }
}

$pdo->exec("
    CREATE TABLE IF NOT EXISTS alunos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        curso VARCHAR(100) NOT NULL,
        data_matricula DATE NOT NULL
    )
");