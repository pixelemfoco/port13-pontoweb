<?php
// auth.php
// Não exibir erros em produção aqui. Logar internamente.
error_reporting(E_ALL);
ini_set('display_errors', 0);
session_start();

require_once __DIR__.'/includes/config.php'; // inclui $pdo

$cod = trim($_POST['cod_funcionario'] ?? '');
$senha = $_POST['senha'] ?? '';
$csrf = $_POST['csrf_token'] ?? '';

// validar CSRF
if (empty($csrf) || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $csrf)) {
    header('Location: login.php?err=1'); exit;
}

if (!$cod || !$senha) {
    header('Location: login.php?err=1');
    exit;
}

$sql = "SELECT id, nome, senha, nivel_acesso FROM TbUsuariosGeral WHERE cod_funcionario = ? AND status = 1 LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$cod]);
$user = $stmt->fetch();

if ($user && password_verify($senha, $user['senha'])) {
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['cod_funcionario'] = $cod;
    $_SESSION['nome'] = $user['nome'];
    $_SESSION['nivel_acesso'] = (int)$user['nivel_acesso'];

    // Atualiza último login (silencioso)
    try {
        $update = $pdo->prepare("UPDATE TbUsuariosGeral SET ultimo_login = NOW() WHERE id = ?");
        $update->execute([$user['id']]);
    } catch (Exception $e) {
        error_log('Failed update last login: ' . $e->getMessage());
    }

    if ($_SESSION['nivel_acesso'] === 1) {
        header('Location: admin/dashboard.php');
    } else {
        header('Location: usr/dashboard.php');
    }
    exit;
} else {
    header('Location: login.php?err=1');
    exit;
}
