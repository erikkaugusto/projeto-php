<?php
require_once __DIR__ . '../../Models/DAO/MarcaDAO.php';
require_once __DIR__ . '../../Models/Marca.php';

class ControlaMarca
{
    private MarcaDAO $dao;

    public function __construct()
    {
        $this->dao = new MarcaDAO();
    }

    public function listarTodos(): void
    {
        $todos = $this->dao->listar();
        echo json_encode($todos);
    }

    public function buscarPorId(int $id): void
    {
        $marca = $this->dao->buscarPorId($id);
        if ($marca === null) {
            http_response_code(404);
            echo json_encode(['error' => 'Marca não encontrado']);
        } else {
            echo json_encode($marca);
        }
    }

    public function salvar(array $data): void
    {
        $marca = new Marca(
            $data['nome'],
            (int) $data['anofundacao'],
            $data['pais'],
            $data['ativo']
        );
        $novoId = $this->dao->salvar($marca);
        $criado = $this->dao->buscarPorId($novoId);

        http_response_code(201);
        echo json_encode($criado);
    }

    public function atualizar(int $id, array $data): void
    {
        $marcaExiste = $this->dao->buscarPorId($id);
        if ($marcaExiste === null) {
            http_response_code(404);
            echo json_encode(['error' => 'Marca não encontrada']);
            return;
        }

        $nome = $data['nome'];
        $anofundacao = $data['anofundacao'];
        $pais = $data['pais'];
        $ativo = $data['ativo'];

        $marca = new Marca($nome, $anofundacao, $pais, $ativo);
        $marca->setId($id);
        $marcaAtualizada = $this->dao->atualizar($marca);

        if ($marcaAtualizada) {
            $atualizado = $this->dao->buscarPorId($id);
            echo json_encode($atualizado);
            http_response_code(200);
        }
    }

    public function excluir(int $id): void
    {
        $marcaExiste = $this->dao->buscarPorId($id);
        if ($marcaExiste === null) {
            http_response_code(404);
            echo json_encode(['error' => 'Marca não encontrada']);
            return;
        }

        $apagado = $this->dao->excluir($id);
        if ($apagado) {
            http_response_code(204);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Falha ao excluir marca']);
        }
    }
}