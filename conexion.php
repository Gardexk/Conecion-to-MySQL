<?php
function conectaDB()
{
    $host = getenv('MYSQL_HOST') ?: 'localhost';
    $user = getenv('MYSQL_USER') ?: 'root';
    $pass = getenv('MYSQL_PASSWORD') ?: 'matematicas';
    $db = getenv('MYSQL_DATABASE') ?: 'empresa';

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $link = new mysqli($host, $user, $pass, $db);
        $link->set_charset('utf8mb4');

        return $link;
    } catch (mysqli_sql_exception $error) {
        http_response_code(500);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success' => false,
            'message' => 'No se pudo conectar a la base de datos.',
        ]);
        exit();
    }
}
?>
