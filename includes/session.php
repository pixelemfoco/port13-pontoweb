<?php
// includes/session.php
// Endurece parâmetros de cookie de sessão
$secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => $secure,
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();

if (!isset($_SESSION['cod_funcionario'])) {
    header('Location: /login.php'); exit;
}

function isAdmin() {
    return isset($_SESSION['nivel_acesso']) && (int)$_SESSION['nivel_acesso'] === 1;
}
