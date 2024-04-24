<?php
class Connection
{
    private $host = "localhost";
    private $user = "root";
    private $senha = "";
    private $banco = "gerenciador_de_tarefas";
    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli($this->host, $this->user, $this->senha, $this->banco);
        if ($this->connection->connect_error) {
            echo("Erro de conexao!");
        } else {
            echo ("Conectado com sucesso");
        }
    }

    public function getUsuarios(){
        $query = "SELECT `id_usuario`, `nome` FROM `usuarios`";
        $resultado = $this->connection->query($query);
        $usuarios = array();
        while($row = $resultado->fetch_assoc()){
            $usuarios[] = $row;
        }
        return $usuarios;
    }

    public function getConnection(){
        return $this->connection;
    }
}
