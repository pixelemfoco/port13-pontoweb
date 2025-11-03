# port13-pontoweb

Projeto simples em PHP para registro de ponto (ponto web). Este repositório contém a aplicação principal, páginas de administração e usuários, e scripts auxiliares para teste.

## Estrutura principal

- `auth.php`, `login.php`, `logout.php` — fluxo de autenticação.
- `includes/` — configuração, helpers, sessão e includes compartilhados (header/footer).
- `admin/` — painel administrativo.
- `usr/` — funcionalidades do usuário (bater ponto, visualizar registros).
- `assets/` — CSS, JS e `query.sql` com o esquema do banco.

## Requisitos

- PHP 7.4+ com PDO e driver MySQL
- MySQL/MariaDB
- Servidor web (Apache, Nginx) ou servidor built-in do PHP para testes

## Configuração rápida (desenvolvimento)

1. Faça uma cópia do arquivo de configuração local (se existir) ou crie `includes/config.local.php` com as credenciais do seu banco de dados. Este arquivo NÃO deve ser versionado.

   - Exemplo mínimo (não comite este arquivo):

     <?php
     // includes/config.local.php
     return [
         'db_host' => '127.0.0.1',
         'db_name' => 'nome_do_banco',
         'db_user' => 'usuario',
         'db_pass' => 'senha',
     ];

2. Importe o esquema do banco para criar as tabelas necessárias:

   - Use o arquivo `assets/query.sql` com seu cliente MySQL:
     - No MySQL: importe pelo Workbench ou `source` no console
     - Alternativamente, use uma ferramenta GUI para importar o `query.sql`

3. Inicie o servidor para desenvolvimento (ex.: PHP built-in):

   - No PowerShell (na raiz do projeto):
     php -S localhost:8000

4. Acesse `http://localhost:8000/login.php` e autentique usando usuários existentes na tabela `TbUsuariosGeral`.

## Testes rápidos e verificações

- Verificar sintaxe PHP (rápido):
  - `php -l arquivo.php` para um arquivo específico. Há um script de teste `test_db.php` para checar a conexão com o banco.
- Teste de conexão com o banco:
  - Rode `php test_db.php` para confirmar que a aplicação consegue conectar e executar uma consulta simples.

## Tema e aparência

- O projeto usa `assets/css/style.css` com variáveis CSS e detecção `prefers-color-scheme`.
- Existe um botão de alternância de tema no cabeçalho que persiste a preferência no `localStorage`.

## Segurança e boas práticas

- NÃO commit suas credenciais. `includes/config.local.php` é ignorado pelo `.gitignore`.
- Se você já cometeu credenciais neste repositório no histórico do git, rotacione as senhas imediatamente e considere reescrever o histórico (por exemplo usando `git filter-repo` ou `git filter-branch`). Posso ajudar com isso se desejar.
- O fluxo de login usa `password_hash`/`password_verify`. Há proteção CSRF no formulário de login e session cookies foram reforçados (HttpOnly / SameSite quando aplicável).

## Próximos passos sugeridos

- Remover quaisquer credenciais sensíveis do histórico do git (se aplicável).
- Adicionar um arquivo de exemplo `includes/config.local.php.example` com instruções sem credenciais.
- Adicionar testes automatizados e análise estática (PHPStan / Psalm) para encontrar problemas de segurança e qualidade.

## Contribuição

Sinta-se à vontade para abrir issues e pull requests. Para mudanças sensíveis (configurações, credenciais), prefira instruções no README e exemplos em `.example`.

---

Se quiser, eu posso:
- Criar `includes/config.local.php.example` com o template mencionado.
- Atualizar o `.gitignore` (já atualizei para ignorar padrões adicionais de config local e chaves privadas).
- Ajudar a remover arquivos sensíveis do histórico do Git (me diga se deseja proceder).