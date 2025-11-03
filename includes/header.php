<?php
// includes/header.php
// Não inicia sessão aqui — os arquivos que incluem header devem iniciar a sessão quando necessário.
// Use a variável $pageTitle para personalizar o título da página.
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Ponto'; ?></title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <div class="container">
    <header>
      <?php if (session_status() === PHP_SESSION_ACTIVE && !empty($_SESSION['nome'])): ?>
        <div>Usuário: <strong><?php echo htmlspecialchars($_SESSION['cod_funcionario'] ?? ''); ?></strong> - <?php echo htmlspecialchars($_SESSION['nome'] ?? ''); ?></div>
      <?php endif; ?>

      <div style="float:right; display:flex; gap:10px; align-items:center;">
        <!-- Theme toggle button -->
        <button id="theme-toggle" aria-label="Alternar tema" title="Alternar tema" style="background:transparent;border:1px solid var(--border);color:var(--text);padding:6px 10px;border-radius:6px;cursor:pointer">🌗</button>
        <a href="/logout.php">Sair</a>
      </div>
      <div style="clear:both"></div>
    </header>
