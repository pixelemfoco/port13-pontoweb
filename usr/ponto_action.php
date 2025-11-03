<?php
// public/user/ponto_action.php
require_once __DIR__.'/../../includes/session.php';
require_once __DIR__.'/../../includes/config.php';
require_once __DIR__.'/../../includes/helpers.php';

$input = json_decode(file_get_contents('php://input'), true);
$acao = $input['acao'] ?? '';
$cod = $_SESSION['cod_funcionario'];
$nome = $_SESSION['nome'];

if (!$acao) {
    http_response_code(400); echo json_encode(['error'=>'acao missing']); exit;
}

$hoje = date('Y-m-d');
$horaAgora = date('H:i:s');

// Verificar se já existe registro para hoje
$sql = "SELECT * FROM registros WHERE cod_funcionario = ? AND data = ? LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$cod, $hoje]);
$r = $stmt->fetch();

if (!$r) {
    // criar novo registro vazio e preencher conforme ação
    $entrada = $saida_almoco = $volta_almoco = $saida = null;
    if ($acao === 'entrada') $entrada = $horaAgora;
    if ($acao === 'saida_almoco') $saida_almoco = $horaAgora;
    if ($acao === 'volta_almoco') $volta_almoco = $horaAgora;
    if ($acao === 'saida') $saida = $horaAgora;

    $ins = $pdo->prepare("INSERT INTO registros (nome, data, entrada, saida_almoco, volta_almoco, saida, cod_funcionario, ativo) VALUES (?, ?, ?, ?, ?, ?, ?, 1)");
    $ins->execute([$nome, $hoje, $entrada, $saida_almoco, $volta_almoco, $saida, $cod]);
    echo json_encode(['ok'=>true, 'msg'=>'Registro criado.']);
    exit;
} else {
    // atualizar somente o campo correspondente se estiver vazio
    $updates = [];
    if ($acao === 'entrada' && empty($r['entrada'])) $updates['entrada'] = $horaAgora;
    if ($acao === 'saida_almoco' && empty($r['saida_almoco'])) $updates['saida_almoco'] = $horaAgora;
    if ($acao === 'volta_almoco' && empty($r['volta_almoco'])) $updates['volta_almoco'] = $horaAgora;
    if ($acao === 'saida' && empty($r['saida'])) $updates['saida'] = $horaAgora;

    if (empty($updates)) {
        echo json_encode(['ok'=>false, 'msg'=>'Nenhuma alteração aplicada — já existe valor.']);
        exit;
    }
    $setPart = [];
    $vals = [];
    foreach($updates as $k=>$v){ $setPart[] = "$k = ?"; $vals[] = $v;}
    $vals[] = $r['id_do_ponto'];
    $sqlu = "UPDATE registros SET ".implode(',', $setPart)." WHERE id_do_ponto = ?";
    $pdo->prepare($sqlu)->execute($vals);
    echo json_encode(['ok'=>true,'msg'=>'Registro atualizado.']);
    exit;
}
