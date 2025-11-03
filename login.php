<?php
// public/login.php
session_start();
if (isset($_SESSION['cod_funcionario'])) { header('Location: index.php'); exit; }

// gerar token CSRF simples
if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(16)); }

$pageTitle = 'Login';
require_once __DIR__ . '/includes/header.php';
?>
    <h2>Entrar</h2>
    <form action="auth.php" method="post">
      <label>Código do Funcionário</label>
      <input type="text" name="cod_funcionario" required>
      <label>Senha</label>
      <input type="password" name="senha" required>
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
      <div style="margin-top:12px;"><button type="submit">Entrar</button></div>
    </form>
    <p><a href="https://pixelemfoco.com/portifolio/port10-login/cadastrar.php">Não tenho cadastro</a></p>
    <p><a href="https://pixelemfoco.com/portifolio/port10-login/esquecisenha.php">Esqueci a Senha</a></p>
<?php
require_once __DIR__ . '/includes/footer.php';
