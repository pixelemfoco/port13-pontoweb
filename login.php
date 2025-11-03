<?php
// public/login.php
session_start();
if (isset($_SESSION['cod_funcionario'])) {
  header('Location: index.php'); exit;
}

// gerar token CSRF simples
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title><link rel="stylesheet" href="/assets/css/styles.css"></head>
<body>
  <div class="login-box">
    <h2>Entrar</h2>
    <form action="auth.php" method="post">
      <label>Código do Funcionário</label>
      <input type="text" name="cod_funcionario" required>
      <label>Senha</label>
      <input type="password" name="senha" required>
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(
          
          
          
          $_SESSION['csrf_token']
      ); ?>">
      <button type="submit">Entrar</button>
    </form>
    <p>Nao tenho cadastro</p>
    <p>Esqueci a Senha</p>
  </div>
</body>
</html>
