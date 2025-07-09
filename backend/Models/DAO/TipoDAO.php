<?php
require_once __DIR__ . '../../../Others/Database.php';

class TipoDAO
{
    private $tabela = 'tipos';
    private $db;
    private $connection;

    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->getConnection();
    }

    public function salvar(Tipo $tipo)
    {
        try {
            $sql = "INSERT INTO $this->tabela (nome, categoria) VALUES (?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$tipo->getNome(), $tipo->getCategoria()]);
            $ultimoId = (int) $this->connection->lastInsertId();
            $this->db->closeConnection();
            return ($ultimoId);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao inserir tipo: " . $e->getMessage());
        }
    }

    public function listar()
    {
        try {
            $sql = "SELECT * FROM $this->tabela";
            $stmt = $this->connection->query($sql);
            $tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->db->closeConnection();
            return $tipos;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar tipos: " . $e->getMessage());
        }
    }

    public function excluir($id)
    {
        try {
            $sql = "DELETE FROM $this->tabela WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            $apagado = $stmt->rowCount() > 0;
            $this->db->closeConnection();
            return $apagado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir tipo: " . $e->getMessage());
        }
    }

    public function buscarPorId($id)
    {
        try {
            $sql = "SELECT * FROM $this->tabela WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            $tipo = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->db->closeConnection();
            return $tipo;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar tipo: " . $e->getMessage());
        }
    }

    public function atualizar(Tipo $tipo)
    {
        try {
            $sql = "UPDATE $this->tabela SET nome = ?, categoria = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $tipo->getNome(),
                $tipo->getCategoria()
            ]);
            $atualizados = $stmt->rowCount() > 0;
            $this->db->closeConnection();
            return $atualizados;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar tipo: " . $e->getMessage());
        }
    }
}
