<?php

$host = getenv("DB_HOST") ?: "127.0.0.1";
$port = (int) (getenv("DB_PORT") ?: 3306);
$user = getenv("DB_USER") ?: "root";
$pass = getenv("DB_PASSWORD");
$db = getenv("DB_NAME") ?: "sistema_crud";

if ($pass === false) {
    $pass = getenv("DB_PASS");
}

if ($pass === false) {
    $pass = "";
}

$conn = new mysqli($host, $user, $pass, $db, $port);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    $appEnv = getenv("APP_ENV") ?: "local";
    $erroBase = "Erro na conexao com o banco de dados.";

    if ($appEnv !== "production") {
        $erroBase .= " Detalhes: " . $conn->connect_error;
    }

    die($erroBase);
}

?>
