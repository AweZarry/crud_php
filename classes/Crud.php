<?php
include_once('database/conexao.php');

$db = new Conexao();

class Crud
{
    private $conn;
    private $table_name = "carros";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($postValues)
    {
        $marca = $postValues['marca'];
        $modelo = $postValues['modelo'];
        $ano_de_fabricacao = $postValues['ano_de_fabricacao'];
        $cor = $postValues['cor'];
        $tipo_de_combustivel = $postValues['tipo_de_combustivel'];
        $n_de_portas = $postValues['n_de_portas'];
        $quilometragem = $postValues['quilometragem'];
        $preco = $postValues['preco'];

        $query = "INSERT INTO " . $this->table_name . " (marca, modelo, ano_de_fabricacao, cor, tipo_de_combustivel, n_de_portas, quilometragem, preco) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $marca);
        $stmt->bindParam(2, $modelo);
        $stmt->bindParam(3, $ano_de_fabricacao);
        $stmt->bindParam(4, $cor);
        $stmt->bindParam(5, $tipo_de_combustivel);
        $stmt->bindParam(6, $n_de_portas);
        $stmt->bindParam(7, $quilometragem);
        $stmt->bindParam(8, $preco);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update($postValues)
    {

        $id_carro = $postValues['id_carro'];
        $marca = $postValues['marca'];
        $modelo = $postValues['modelo'];
        $ano_de_fabricacao = $postValues['ano_de_fabricacao'];
        $cor = $postValues['cor'];
        $tipo_de_combustivel = $postValues['tipo_de_combustivel'];
        $n_de_portas = $postValues['n_de_portas'];
        $quilometragem = $postValues['quilometragem'];
        $preco = $postValues['preco'];

        if (empty($id_carro) || empty($marca) || empty($modelo) || empty($ano_de_fabricacao) || empty($cor) || empty($tipo_de_combustivel) || empty($n_de_portas) || empty($quilometragem) || empty($preco)) {
            return false;
        }

        $query = "UPDATE " . $this->table_name . " SET marca = ?, modelo = ?, ano_de_fabricacao = ?, cor = ?, tipo_de_combustivel = ?, n_de_portas = ?, quilometragem = ?, preco = ? WHERE id_carro = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $modelo);
        $stmt->bindParam(2, $marca);
        $stmt->bindParam(3, $ano_de_fabricacao);
        $stmt->bindParam(4, $cor);
        $stmt->bindParam(5, $tipo_de_combustivel);
        $stmt->bindParam(6, $n_de_portas);
        $stmt->bindParam(7, $quilometragem);
        $stmt->bindParam(8, $preco);
        $stmt->bindParam(9, $id_carro);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function search($term)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE marca LIKE ? OR modelo LIKE ? OR ano_de_fabricacao LIKE ?";
        $stmt = $this->conn->prepare($query);
        $term = "%" . $term . "%";
        $stmt->bindParam(1, $term);
        $stmt->bindParam(2, $term);
        $stmt->bindParam(3, $term);
        $stmt->execute();
        return $stmt;
    }

    public function readOne($id_carro)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_carro = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_carro);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id_carro)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_carro = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_carro);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
