<?php
require_once __DIR__.'/../../includes/session.php';
if (!isAdmin()) { header('Location: /login.php'); exit; }
require_once __DIR__.'/../../includes/config.php';

$pageTitle = 'Admin';
// includes is one level up from /admin
require_once __DIR__.'/../includes/header.php';
?>
    <h1>Admin Dashboard</h1>
    <p>Ações administrativas</p>
    <a class="add-button" href="manage_registros.php">Gerenciar Registros</a>
    <a class="add-button" href="feriados.php">Cadastrar Feriados</a>
    <a class="add-button" href="faltas.php">Controle de Faltas / Justificativas</a>
<?php
require_once __DIR__.'/../../includes/footer.php';
