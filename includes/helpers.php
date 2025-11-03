<?php
// includes/helpers.php
function calculaTotalHorasSegundos($entrada, $saida, $saida_almoco=null, $volta_almoco=null) {
    if (!$entrada || !$saida) return 0;
    $entradaTs = strtotime($entrada);
    $saidaTs = strtotime($saida);
    $almoco = 0;
    if ($saida_almoco && $volta_almoco) {
        $almoco = max(0, strtotime($volta_almoco) - strtotime($saida_almoco));
    }
    return max(0, ($saidaTs - $entradaTs) - $almoco);
}

function formatarHoras($segundos) {
    $h = floor($segundos / 3600);
    $m = floor(($segundos % 3600) / 60);
    return sprintf("%02d:%02d", $h, $m);
}

function nomeDiaSemana($date) {
    $dias = [1=>'Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'];
    return $dias[date('N', strtotime($date))];
}
