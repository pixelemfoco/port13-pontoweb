<?php
require_once __DIR__.'/../../includes/session.php';
if (!isAdmin()) { header('Location: /public/login.php'); exit; }
require_once __DIR__.'/../../includes/config.php';
?>
<!doctype html><html>
<head><meta charset="utf-8"><title>Admin</title></head>
<body>
<h1>Admin Dashboard</h1>
<ul>
  <li><a href="manage_registros.php">Gerenciar Registros</a></li>
  <li><a href="feriados.php">Cadastrar Feriados</a></li>
  <li><a href="faltas.php">Controle de Faltas / Justificativas</a></li>
</ul>
</body>
</html>
