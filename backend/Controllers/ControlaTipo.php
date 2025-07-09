<?php
require_once __DIR__ . '../../Models/DAO/TipoDAO.php';
require_once __DIR__ . '../../Models/Tipo.php';

class ControlaTipo
{
    private TipoDAO $dao;

    public function __construct()
    {
        $this->dao = new TipoDAO();
    }

    public function listarTodos(): void
    {
        $todos = $this->dao->listar();
        echo json_encode($todos);
    }

    public function buscarPorId(int $id): void
    {
        $tipo = $this->dao->buscarPorId($id);
        if ($tipo === null) {
            http_response_code(404);
            echo json_encode(['error' => 'Tipo não encontrado']);
        } else {
            echo json_encode($tipo);
        }
    }

    public function salvar(array $data): void
    {
        $tipo = new Tipo(
            $data['nome'],
            $data['categoria'],
        );
        $novoId = $this->dao->salvar($tipo);
        $criado = $this->dao->buscarPorId($novoId);

        http_response_code(201);
        echo json_encode($criado);
    }

    public function atualizar(int $id, array $data): void
    {
        $tipoExiste = $this->dao->buscarPorId($id);
        if ($tipoExiste === null) {
            http_response_code(404);
            echo json_encode(['error' => 'Tipo não encontrado']);
            return;
        }

        $nome = $data['nome'];
        $categoria = $data['categoria'];

        $tipo = new Tipo($nome, $categoria);
        $tipo->setId($id);
        $tipoAtualizado = $this->dao->atualizar($tipo);

        if ($tipoAtualizado) {
            $atualizado = $this->dao->buscarPorId($id);
            echo json_encode($atualizado);
            http_response_code(200);
        }
    }

    public function excluir(int $id): void
    {
        $tipoExiste = $this->dao->buscarPorId($id);
        if ($tipoExiste === null) {
            http_response_code(404);
            echo json_encode(['error' => 'Tipo não encontrado']);
            return;
        }

        $apagado = $this->dao->excluir($id);
        if ($apagado) {
            http_response_code(204);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Falha ao excluir tipo']);
        }
    }
}