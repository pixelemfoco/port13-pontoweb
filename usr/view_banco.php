<?php
require_once __DIR__.'/../../includes/session.php';
require_once __DIR__.'/../../includes/config.php';
require_once __DIR__.'/../../includes/helpers.php';

$cod = $_SESSION['cod_funcionario'];
$mes = $_GET['mes'] ?? date('Y-m'); // formato YYYY-MM
$inicio = (new DateTime($mes.'-01'))->format('Y-m-01');
$fim = (new DateTime($mes.'-01'))->format('Y-m-t');

// buscar registros do mês para este funcionário
$sql = "SELECT * FROM registros WHERE cod_funcionario = ? AND data BETWEEN ? AND ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$cod, $inicio, $fim]);
$rows = $stmt->fetchAll();
$map = [];
foreach($rows as $r) $map[$r['data']][] = $r; // pode haver multi registros por dia

// jornada diária (configurável) em segundos
$jornadaSeg = 8 * 3600;

$period = new DatePeriod(new DateTime($inicio), new DateInterval('P1D'), (new DateTime($fim))->modify('+1 day'));

$totalMesSeg = 0;
$totalBancoSeg = 0;

?>
<?php
$pageTitle = 'Banco de Horas — '.htmlspecialchars((new DateTime($inicio))->format('F Y'));
require_once __DIR__.'/../../includes/header.php';
?>
        <h2>Banco de Horas — <?= htmlspecialchars((new DateTime($inicio))->format('F Y')) ?></h2>
        <p><a href="../dashboard.php">Voltar ao Dashboard</a></p>
        <table><thead><tr><th>Dia</th><th>Data</th><th>Semana</th><th>Entrada</th><th>Saída Alm</th><th>Volta Alm</th><th>Saída</th><th>Total</th><th>Banco</th></tr></thead><tbody>
<?php
foreach($period as $d) {
    $ds = $d->format('Y-m-d');
    $entrada=''; $saida_almoco=''; $volta_almoco=''; $saida='';
    $totalSegDia = 0;

    if (isset($map[$ds])) {
        // se múltiplos registros no mesmo dia, devemos agregar — aqui somamos tempos válidos (ex.: caso de multiplas entradas)
        // Para simplicidade, vamos pegar o registro mais completo (o último) — ou usar lógica de agregação se preferir
        $r = end($map[$ds]);
        $entrada = $r['entrada']; $saida_almoco = $r['saida_almoco']; $volta_almoco = $r['volta_almoco']; $saida = $r['saida'];
        $totalSegDia = calculaTotalHorasSegundos($entrada, $saida, $saida_almoco, $volta_almoco);
    }

    $weekName = nomeDiaSemana($ds);
    $bancoSeg = ((int)$d->format('N') <= 5) ? ($totalSegDia - $jornadaSeg) : 0;
    $totalMesSeg += $totalSegDia;
    $totalBancoSeg += $bancoSeg;

    echo "<tr>";
    echo "<td>" . htmlspecialchars($d->format('d')) . "</td>";
    echo "<td>" . htmlspecialchars($ds) . "</td>";
    echo "<td>" . htmlspecialchars($weekName) . "</td>";
    echo "<td>" . htmlspecialchars($entrada) . "</td>";
    echo "<td>" . htmlspecialchars($saida_almoco) . "</td>";
    echo "<td>" . htmlspecialchars($volta_almoco) . "</td>";
    echo "<td>" . htmlspecialchars($saida) . "</td>";
    echo "<td>" . htmlspecialchars(formatarHoras($totalSegDia)) . "</td>";
    echo "<td>" . htmlspecialchars(($bancoSeg>=0?'+':'') . formatarHoras(abs($bancoSeg))) . "</td>";
    echo "</tr>";
}
?>
    </tbody></table>
    <div class="totais">Total mês: <?= htmlspecialchars(formatarHoras($totalMesSeg)) ?> — Banco mês: <?= htmlspecialchars(($totalBancoSeg>=0?'+':'')) ?><?= htmlspecialchars(formatarHoras(abs($totalBancoSeg))) ?></div>
<?php
require_once __DIR__.'/../../includes/footer.php';

