// assets/js/app.js
function baterPonto(tipo) {
  if (!confirm('Confirma ' + tipo + '?')) return;
  fetch('/public/user/ponto_action.php', {
    method: 'POST',
    headers: {'Content-Type':'application/json'},
    body: JSON.stringify({acao: tipo})
  }).then(r => r.json()).then(resp => {
    document.getElementById('ponto-msg').innerText = resp.msg || JSON.stringify(resp);
  }).catch(e => {
    document.getElementById('ponto-msg').innerText = 'Erro: ' + e;
  });
}

// Theme toggle: supports cycle [auto -> dark -> light -> auto], persisted in localStorage
(function(){
  const KEY = 'theme'; // values: 'auto'|'dark'|'light'
  const btn = document.getElementById('theme-toggle');
  if (!btn) return;

  function applyTheme(value){
    if (value === 'dark') {
      document.documentElement.setAttribute('data-theme','dark');
      btn.textContent = '🌙';
      btn.title = 'Tema: escuro (clique para claro)';
    } else if (value === 'light') {
      document.documentElement.setAttribute('data-theme','light');
      btn.textContent = '☀️';
      btn.title = 'Tema: claro (clique para automático)';
    } else {
      document.documentElement.removeAttribute('data-theme');
      btn.textContent = '🌗';
      btn.title = 'Tema: automático (baseado no sistema)';
    }
  }

  // initialize
  let saved = localStorage.getItem(KEY) || 'auto';
  if (saved === 'auto') saved = 'auto';
  applyTheme(saved === 'auto' ? null : saved);

  btn.addEventListener('click', function(){
    let current = localStorage.getItem(KEY) || 'auto';
    let next;
    if (current === 'auto') next = 'dark';
    else if (current === 'dark') next = 'light';
    else next = 'auto';
    if (next === 'auto') {
      localStorage.setItem(KEY,'auto');
      applyTheme(null);
    } else {
      localStorage.setItem(KEY,next);
      applyTheme(next);
    }
  });
})();
