<?php
require_once __DIR__.'/../../includes/session.php';
require_once __DIR__.'/../../includes/config.php';
$cod = $_SESSION['cod_funcionario'];
$nome = $_SESSION['nome'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard - <?=htmlspecialchars($nome)?></title>
<link rel="stylesheet" href="/assets/css/styles.css">
<script src="/assets/js/app.js"></script>
</head>
<body>
<header>
  <div>Funcionário: <strong><?=htmlspecialchars($cod)?></strong> - <?=htmlspecialchars($nome)?></div>
  <a href="/public/logout.php">Sair</a>
</header>

<main>
  <h3>Bater Ponto</h3>
  <div id="ponto-msg"></div>
  <div class="ponto-buttons">
    <button data-action="entrada" onclick="baterPonto('entrada')">Entrada</button>
    <button data-action="saida_almoco" onclick="baterPonto('saida_almoco')">Saída almoço</button>
    <button data-action="volta_almoco" onclick="baterPonto('volta_almoco')">Volta almoço</button>
    <button data-action="saida" onclick="baterPonto('saida')">Saída</button>
  </div>

  <h3>Banco de Horas</h3>
  <form id="form-mes" method="get" action="view_banco.php">
    <label>Mês: <input type="month" name="mes" value="<?=date('Y-m')?>"></label>
    <button>Ver</button>
  </form>
  <div id="banco-area"></div>
</main>
</body>
</html>
