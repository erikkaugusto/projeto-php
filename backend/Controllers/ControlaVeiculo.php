<?php
require_once __DIR__ . '../../Models/DAO/VeiculoDAO.php';
require_once __DIR__ . '../../Models/Veiculo.php';

class ControlaVeiculo
{
    private VeiculoDAO $dao;

    public function __construct()
    {
        $this->dao = new VeiculoDAO();
    }

    public function listarTodos(): void
    {
        $todos = $this->dao->listar();
        echo json_encode($todos);
    }

    public function buscarPorId(int $id): void
    {
        $veiculo = $this->dao->buscarPorId($id);
        if ($veiculo === null) {
            http_response_code(404);
            echo json_encode(['error' => 'Veículo não encontrado']);
        } else {
            echo json_encode($veiculo);
        }
    }

    public function salvar(array $data): void
    {
        $veiculo = new Veiculo(
            $data['marca'],
            $data['modelo'],
            $data['placa'],
            (int) $data['ano'],
            $data['cor'],
            $data['tipo'],
            $data['status']
        );
        $novoId = $this->dao->salvar($veiculo);
        $criado = $this->dao->buscarPorId($novoId);

        http_response_code(201);
        echo json_encode($criado);
    }

    public function atualizar(int $id, array $data): void
    {
        $veiculoExiste = $this->dao->buscarPorId($id);
        if ($veiculoExiste === null) {
            http_response_code(404);
            echo json_encode(['error' => 'Veículo não encontrado']);
            return;
        }

        $marca = $data['marca'];
        $modelo = $data['modelo'];
        $placa = $data['placa'];
        $ano = $data['ano'];
        $cor = $data['cor'];
        $tipo = $data['tipo'];
        $status = $data['status'];

        $veiculo = new Veiculo($marca, $modelo, $placa, $ano, $cor, $tipo, $status);
        $veiculo->setId($id);
        $veiculoAtualizado = $this->dao->atualizar($veiculo);

        if ($veiculoAtualizado) {
            $atualizado = $this->dao->buscarPorId($id);
            echo json_encode($atualizado);
            http_response_code(200);
        }
    }

    public function excluir(int $id): void
    {
        $veiculoExiste = $this->dao->buscarPorId($id);
        if ($veiculoExiste === null) {
            http_response_code(404);
            echo json_encode(['error' => 'Veículo não encontrado']);
            return;
        }

        $apagado = $this->dao->excluir($id);
        if ($apagado) {
            http_response_code(204);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Falha ao excluir veículo']);
        }
    }
}