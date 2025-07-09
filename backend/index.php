<?php
require_once __DIR__ . '/Controllers/ControlaVeiculo.php';
require_once __DIR__ . '/Controllers/ControlaTipo.php';
require_once __DIR__ . '/Controllers/ControlaMarca.php';

// ===== CORS e Headers comuns =====
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// ===== Lê entrada e URI =====
$input  = file_get_contents('php://input');
$dados  = json_decode($input, true);

$uri        = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
[$recurso, $id] = array_pad(explode('/', $uri, 2), 2, null);
$id = is_numeric($id) ? (int)$id : null;

// ===== Roteador central =====
$roteador = [
    'veiculos' => new ControlaVeiculo(),
    'tipos'    => new ControlaTipo(),
    'marcas'   => new ControlaMarca(),
    // Adicione mais controladores aqui se necessário
];

// ===== Validação da rota =====
if (!isset($roteador[$recurso])) {
    http_response_code(404);
    echo json_encode(['error' => 'Recurso não encontrado']);
    exit;
}

$ctrl = $roteador[$recurso];

// ===== Despacha ação com base no método HTTP =====
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $id === null ? $ctrl->listarTodos() : $ctrl->buscarPorId($id);
        break;

    case 'POST':
        $ctrl->salvar($dados);
        break;

    case 'PUT':
        if ($id === null) {
            http_response_code(400);
            echo json_encode(['error' => 'ID obrigatório para atualizar']);
        } else {
            $ctrl->atualizar($id, $dados);
        }
        break;

    case 'DELETE':
        if ($id === null) {
            http_response_code(400);
            echo json_encode(['error' => 'ID obrigatório para excluir']);
        } else {
            $ctrl->excluir($id);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método não permitido']);
}
