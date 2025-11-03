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
