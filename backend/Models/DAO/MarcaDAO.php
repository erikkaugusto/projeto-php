<?php
require_once __DIR__ . '../../../Others/Database.php';

class MarcaDAO
{
    private $tabela = 'marcas';
    private $db;
    private $connection;

    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->getConnection();
    }

    public function salvar(Marca $marca)
    {
        try {
            $sql = "INSERT INTO $this->tabela (nome, anofundacao, pais, ativo) VALUES (?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$marca->getNome(), $marca->getAnoFundacao(), $marca->getPais(), $marca->getAtivo()]);
            $ultimoId = (int) $this->connection->lastInsertId();
            $this->db->closeConnection();
            return ($ultimoId);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao inserir marca: " . $e->getMessage());
        }
    }

    public function listar()
    {
        try {
            $sql = "SELECT * FROM $this->tabela";
            $stmt = $this->connection->query($sql);
            $marcas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->db->closeConnection();
            return $marcas;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar marcas: " . $e->getMessage());
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
            throw new \Exception("Erro ao excluir marca: " . $e->getMessage());
        }
    }

    public function buscarPorId($id)
    {
        try {
            $sql = "SELECT * FROM $this->tabela WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            $marca = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->db->closeConnection();
            return $marca;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar marca: " . $e->getMessage());
        }
    }

    public function atualizar(Marca $marca)
    {
        try {
            $sql = "UPDATE $this->tabela SET nome = ?, anofundacao = ?, pais = ?, ativo = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $marca->getNome(),
                $marca->getAnoFundacao(),
                $marca->getPais(),
                $marca->getAtivo(),
                $marca->getId()
            ]);
            $atualizados = $stmt->rowCount() > 0;
            $this->db->closeConnection();
            return $atualizados;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar marca: " . $e->getMessage());
        }
    }
}
