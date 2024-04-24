<?php
require("conexao.php");

class DeletarUsuario {
    private $connect;

public function __construct($connect)
{
    $this->connect = $connect;
}
public function Excluir($id){
    $id = intval($id);
                                        /* nao esqueça a função q conecta */
    $query = mysqli_query($this->connect->getConnection(),  "DELETE FROM `usuarios` WHERE `id_usuario`='$id'");
    return $query;
}
}
$connect = new Connection();
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $excluirUsuario = new DeletarUsuario($connect);
    $id = $_GET['id'];

    if ($excluirUsuario->excluir($id)) {
        header("location:../tabela_usuarios.php");
        exit(); // Termina o script para garantir que o redirecionamento ocorra sem problemas
    } else {
        echo "Erro ao excluir usuário.";
    }
} else {
    echo "ID inválido ou inexistente.";
}
?>