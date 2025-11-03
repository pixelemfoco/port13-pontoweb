<?php
// includes/session.php
session_start();
if (!isset($_SESSION['cod_funcionario'])) {
    header('Location: /public/login.php'); exit;
}
function isAdmin() {
    return isset($_SESSION['nivel_acesso']) && $_SESSION['nivel_acesso'] == 1;
}
