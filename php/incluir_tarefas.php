<?php


include_once("conexao.php");
class Tarefas
{
    public $conexao;
    public $nome;
    public $desc;
    public $prazo;
    public $prioridade;
    public $conclusao;
    public $usuario;
    public $mensagem;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function InserirTarefas()
    {
        // Verifica se o campo "concluida" foi enviado
        if (isset($_POST["concluida"])) {
            // Verifica o valor do checkbox de conclusão
            if ($_POST["concluida"] == "sim") {
                $conclusao = "sim";
            } else {
                $conclusao = "não";
            }
        } else {
            // Se o campo "concluida" não foi enviado, define a conclusão como "não"
            $conclusao = "não";
        }
        // Inserir a tarefa no banco de dados
        $sql = "INSERT INTO `tarefas`(`tarefa`, `descricao`, `prazo`, `prioridade`, `conclusao`, `id_usuario`) VALUES ('$this->nome','$this->desc','$this->prazo','$this->prioridade','$conclusao','$this->usuario')";
        $query = mysqli_query($this->conexao->getConnection(), $sql);

        if($query){
            $this->mensagem = "Tarefa cadastrada com Sucesso";
        }else{
            $this->mensagem = "Erro ao cadastrar a tarefa";
        }
    }
    
}


$conexao = new Connection();
$tarefas = new Tarefas($conexao);
$tarefas->nome = $_POST['nome'];
$tarefas->desc = $_POST['descricao'];
$tarefas->prazo = $_POST['prazo'];
$tarefas->prioridade = $_POST['prioridade'];
$tarefas->usuario = $_POST['id_usuario'];

$tarefas->InserirTarefas();
if(!empty($tarefas->mensagem)){
    echo "<p>{$tarefas->mensagem}</p>";
}