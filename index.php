<?php
// index.php - página de instruções / landing simples
$pageTitle = 'Bem-vindo ao PontoWeb';
require_once __DIR__ . '/includes/header.php';
?>
    <h2>Bem-vindo ao PontoWeb</h2>
    <p>Este é um sistema simples de registro de ponto. Use os links abaixo para navegar:</p>

    <ul>
      <li><a class="add-button" href="https://pixelemfoco.com/portifolio/port10-login/cadastrar.php">Cadastrar (novo usuário)</a></li>
      <li><a href="login.php">Entrar (login)</a></li>
      <li><a href="https://pixelemfoco.com/portifolio/port10-login/esquecisenha.php">Esqueci a senha</a></li>
    </ul>

    <h3>Como usar</h3>
    <ol>
      <li>Cadastre-se (ou peça ao administrador para cadastrar seu usuário).</li>
      <li>Faça login com seu código de funcionário e senha.</li>
      <li>Use o painel para bater o ponto e consultar o banco de horas.</li>
    </ol>

    <p>Observação: as páginas <code>/register.php</code> e <code>/forgot.php</code> são links de exemplo. Se ainda não existirem no projeto, posso criá-las como formulários simples quando você desejar.</p>

<?php
require_once __DIR__ . '/includes/footer.php';
