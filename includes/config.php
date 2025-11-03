<?php
// includes/config.php
date_default_timezone_set('America/Sao_Paulo');

// Carrega configuração local se existir (arquivo não versionado) para evitar credenciais no repositório.
// Crie um arquivo includes/config.local.php com as constantes DB_HOST, DB_NAME, DB_USER, DB_PASS em ambiente local.
if (file_exists(__DIR__ . '/config.local.php')) {
    require __DIR__ . '/config.local.php';
} else {
    // Tenta obter das variáveis de ambiente (útil para deployment)
    define('DB_HOST', getenv('DB_HOST') ?: '');
    define('DB_NAME', getenv('DB_NAME') ?: '');
    define('DB_USER', getenv('DB_USER') ?: '');
    define('DB_PASS', getenv('DB_PASS') ?: '');
}

// Validação simples para evitar tentar conectar sem credenciais
if (empty(DB_HOST) || empty(DB_NAME) || empty(DB_USER)) {
    error_log('Database configuration missing. Set includes/config.local.php or environment variables.');
    die('Erro de configuração do sistema. Contate o administrador.');
}

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (Exception $e) {
    // Não expor detalhes de erro ao usuário; logar para depuração
    error_log('DB connection error: ' . $e->getMessage());
    die('Erro ao conectar com o banco de dados.');
}
