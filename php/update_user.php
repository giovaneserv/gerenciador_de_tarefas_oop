<?php
require("conexao.php");

class Usuario
{
    protected $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function atualizarUsuario($id, $nome, $email, $endereco, $cidade, $estado, $cep)
    {
        $query = mysqli_query($this->connect->getConnection(), "UPDATE `usuarios` SET `nome`='$nome',`email`='$email',`endereco`='$endereco',`cidade`='$cidade',`estado`='$estado',`cep`='$cep' WHERE `id_usuario`='$id'");

        return $query;
    }
}

class UsuarioEditavel extends Usuario
{
    public function __construct($connect)
    {
        parent::__construct($connect);
    }
}

$connect = new Connection();
// Uso da classe para editar um usuário
$usuarioEditavel = new UsuarioEditavel($connect);

$id = $_GET["id"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$endereco = $_POST["endereco"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$cep = $_POST["cep"];

$query = $usuarioEditavel->atualizarUsuario($id, $nome, $email, $endereco, $cidade, $estado, $cep);

if ($query) {
    header("location:../tabela_usuarios.php?mensagem=Atualizado com sucesso!");
} else {
    echo "Erro ao atualizar usuário.";
}
?>