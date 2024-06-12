<?php
$host = 'dbloginserver.database.windows.net'; // ou o endereço do seu servidor MySQL
$db   = 'dblogin';
$user = 'id22299978_pr0cessview2024';
$pass = 'EWb5$e.E76JzWQf';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
