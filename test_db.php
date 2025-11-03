<?php
// test_db.php - pequeno script para testar a conexão ao banco usando includes/config.php
require_once __DIR__ . '/includes/config.php';
echo "Tentando conectar com o banco...\n";
try {
    $stmt = $pdo->query('SELECT 1');
    $res = $stmt->fetch();
    echo "Consulta de teste executada com sucesso: ";
    var_export($res);
    echo "\n";
} catch (Throwable $e) {
    echo "Erro na query: " . $e->getMessage() . "\n";
}
