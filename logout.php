<?php
// logout.php - encerra a sessão do usuário de forma segura e redireciona para login
session_start();

// Limpa todas as variáveis de sessão
$_SESSION = [];

// Remove cookie de sessão
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'], $params['secure'], $params['httponly']
    );
}

// Destrói sessão no servidor
session_destroy();

// Redireciona para a página de login
header('Location: /login.php');
exit;
