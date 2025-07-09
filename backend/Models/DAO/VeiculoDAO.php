<?php
require_once __DIR__ . '../../../Others/Database.php';

class VeiculoDAO
{
    private $tabela = 'veiculos';
    private $db;
    private $connection;

    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->getConnection();
    }

    public function salvar(Veiculo $veiculo)
    {
        try {
            $sql = "INSERT INTO $this->tabela (marca, modelo, placa, ano, cor, tipo, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$veiculo->getMarca(), $veiculo->getModelo(), $veiculo->getPlaca(), $veiculo->getAno(), $veiculo->getCor(), $veiculo->getTipo(), $veiculo->getStatus()]);
            $ultimoId = (int) $this->connection->lastInsertId();
            $this->db->closeConnection();
            return ($ultimoId);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao inserir veículo: " . $e->getMessage());
        }
    }

    public function listar()
    {
        try {
            $sql = "SELECT * FROM $this->tabela";
            $stmt = $this->connection->query($sql);
            $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->db->closeConnection();
            return $veiculos;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar veículos: " . $e->getMessage());
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
            throw new \Exception("Erro ao excluir veículo: " . $e->getMessage());
        }
    }

    public function buscarPorId($id)
    {
        try {
            $sql = "SELECT * FROM $this->tabela WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->db->closeConnection();
            return $veiculo;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar veículo: " . $e->getMessage());
        }
    }

    public function atualizar(Veiculo $veiculo)
    {
        try {
            $sql = "UPDATE $this->tabela SET marca = ?, modelo = ?, placa = ?, ano = ?, cor = ?, tipo = ?, status = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $veiculo->getMarca(),
                $veiculo->getModelo(),
                $veiculo->getPlaca(),
                $veiculo->getAno(),
                $veiculo->getCor(),
                $veiculo->getTipo(),
                $veiculo->getStatus(),
                $veiculo->getId()
            ]);
            $atualizados = $stmt->rowCount() > 0;
            $this->db->closeConnection();
            return $atualizados;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar veículo: " . $e->getMessage());
        }
    }
}
