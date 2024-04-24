<?php
session_start();
include("conexao.php");

class Autenticação{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao= $conexao;
    }
    public function autenticar($email, $senha){
        $query = "SELECT * FROM `usuarios` WHERE `email`='$email'";
        $res= mysqli_query($this->conexao, $query);
        if($res->num_rows==1){
        $usuario = mysqli_fetch_assoc($res);
        if(password_verify($senha, $usuario['senha'])){
            $_SESSION["id_usuario"] = $usuario["id_usuario"];
            $_SESSION["email_usuario"] = $usuario["email"];
            return true;
        }else{
            return false;
        }
        }else{
            return false;
        }
    }
}

if ($_SERVER['REQUEST_METHOD']=="POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $autenticação = new Autenticação($conexao);
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    if($autenticação->autenticar($email, $senha)){
        header('location:form.php');
    }else{
        echo "Login Incorreto";
    }
}
?>