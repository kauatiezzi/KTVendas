<?php
$env = getenv('DATABASE_URL');
if ($env) {
    $url = parse_url($env);
    $host = $url["host"];
    $user = $url["user"];
    $pass = $url["pass"];
    $db   = ltrim($url["path"], '/');
    
    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {
        die("Erro de conexão: " . $e->getMessage());
    }
} else {
    die("Variável DATABASE_URL não encontrada.");
}
?>
