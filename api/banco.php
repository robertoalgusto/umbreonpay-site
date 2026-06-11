<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$acao = $_GET['acao'] ?? '';

// 100 carteiras por usuário
if ($acao === 'listar_carteiras') {
    $usuario_id = intval($_GET['usuario_id'] ?? 1);
    $carteiras = [];
    for ($i = 1; $i <= 100; $i++) {
        $carteiras[] = [
            "numero" => $i,
            "saldo" => 0,
            "status" => "ativa",
            "endereco" => "4" . md5($usuario_id . $i) . substr(md5($i), 0, 10)
        ];
    }
    echo json_encode(["sucesso" => true, "carteiras" => $carteiras]);
}
// Fragmentação de transação em 100 partes
elseif ($acao === 'depositar_fragmentado') {
    $valor = floatval($_GET['valor'] ?? 0);
    $cotacao_xmr = 1200;
    $valor_xmr = $valor / $cotacao_xmr;
    $fragmentos = [];
    $restante = $valor_xmr;
    for ($i = 0; $i < 99; $i++) {
        $frag = round(rand(1, $restante * 10000) / 10000, 8);
        $fragmentos[] = $frag;
        $restante -= $frag;
    }
    $fragmentos[] = round($restante, 8);
    echo json_encode([
        "sucesso" => true,
        "fragmentos" => count($fragmentos),
        "valor_xmr" => round($valor_xmr, 6),
        "mensagem" => "Depósito de R$ $valor fragmentado em 100 partes XMR"
    ]);
}
else {
    echo json_encode(["erro" => "Ação não encontrada", "acoes" => ["listar_carteiras", "depositar_fragmentado"]]);
}
?>
