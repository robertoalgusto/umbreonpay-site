<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
$acao = $_GET['acao'] ?? '';
if ($acao === 'listar_carteiras') {
    $carteiras = [];
    for ($i = 1; $i <= 100; $i++) {
        $carteiras[] = ["numero" => $i, "saldo" => 0, "status" => "ativa"];
    }
    echo json_encode(["carteiras" => $carteiras]);
}
elseif ($acao === 'depositar_fragmentado') {
    $valor = floatval($_GET['valor'] ?? 0);
    $cotacao_xmr = 1200;
    $valor_xmr = $valor / $cotacao_xmr;
    echo json_encode(["sucesso" => true, "fragmentos" => 100, "valor_xmr" => round($valor_xmr, 6)]);
}
else {
    echo json_encode(["erro" => "Ação não encontrada"]);
}
?>
