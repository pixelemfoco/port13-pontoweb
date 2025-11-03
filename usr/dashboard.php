<?php
require_once __DIR__.'/../../includes/session.php';
require_once __DIR__.'/../../includes/config.php';
$cod = $_SESSION['cod_funcionario'];
$nome = $_SESSION['nome'];

$pageTitle = 'Dashboard - '.htmlspecialchars($nome);
// includes is one level up from /usr
require_once __DIR__.'/../includes/header.php';
?>
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
<?php
require_once __DIR__.'/../../includes/footer.php';
