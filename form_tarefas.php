<?php
session_start();
require("php/conexao.php");

$conexao = new Connection();
$usuarios = $conexao->getUsuarios();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Gerenciador de Tarefas</title>
</head>

<body>
    <h1>Gerenciador de Tarefas</h1>

    <form action="php/incluir_tarefas.php" method="POST">
        <fieldset>
            <legend>Nova Tarefa</legend>

            <label>
                Responsável: <select name="id_usuario">
                    <?php
                    foreach($usuarios as $usuario){
                        echo "<option value='" . $usuario['id_usuario'] . "'>" . $usuario['nome'] . "</option>";
                    }
                    ?>
                </select>
            </label>
            <label>
                Tarefa: <input type="text" name="nome">
            </label>
            <label>
                Descrição: <textarea name="descricao"></textarea>
            </label>
            <label>
                Prazo: <input type="text" name="prazo">
            </label>
            <fieldset>
                <legend>Prioridade</legend>

                <label><input type="radio" name="prioridade" value="baixa" checked> Baixa</label>
                <label><input type="radio" name="prioridade" value="media"> Média</label>
                <label><input type="radio" name="prioridade" value="alta"> Alta</label>
            </fieldset>
            <label>
                conclusão: <input type="checkbox" name="concluida" value="sim" checked>
            </label>

            <input type="submit" value="Cadastrar" name="envia">
        </fieldset>
    </form>
</body>

</html>