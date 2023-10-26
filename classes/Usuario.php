<?php
include("database/conexao.php");

$db = new Conexao();

class registro
{
    private $conn;
    private $table_name = "registros";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function cadastrar($nome_usuario, $email_usuario, $senha, $confSenha)
    {
        if ($senha === $confSenha) {

            $emailExistente = $this->verificarEmailExistente($email_usuario);
            if ($emailExistente) {
                print "<script> alert('Email ja cadastrado')</script>";
                return false;
            }

            $usuarioExistente = $this->verificarUsuarioExistente($nome_usuario);
            if ($usuarioExistente) {
                print "<script> alert('Nome de usuario ja cadastrado')</script>";
                return false;
            }

            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO " . $this->table_name . " (nome_usuario, email_usuario, senha) VALUES (? ,? ,?)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $nome_usuario);
            $stmt->bindParam(2, $email_usuario);
            $stmt->bindParam(3, $senhaCriptografada);

            $rows = $this->read();
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }


    private function verificarEmailExistente($email_usuario)
    {
        $sql = "SELECT COUNT(*) FROM registros WHERE email_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $email_usuario);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    private function verificarUsuarioExistente($nome_usuario)
    {
        $sql = "SELECT COUNT(*) FROM registros WHERE nome_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $nome_usuario);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function logar($login, $senha)
    {
        $query = "SELECT * FROM registros WHERE email_usuario = :email_usuario OR nome_usuario = :nome_usuario ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email_usuario', $login);
        $stmt->bindValue(':nome_usuario', $login);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $usuario['senha'])) {
                return true;
            }
        }

        return false;
    }
    public function read()
    {
        $sql = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}
