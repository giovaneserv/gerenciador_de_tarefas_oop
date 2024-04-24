<?php
session_start();
require("php/conexao.php");
$id = $_GET['id'];
$connect = new Connection();
$sql = mysqli_query($connect->getConnection(), "SELECT * FROM `usuarios` WHERE `id_usuario`='$id'");
$dados = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Edição de Usuário</title>
</head>

<body>
    <h1>Editar Usuário</h1>
                        <!-- o arquivo e a id devem ser postas -->
    <form action="php/update_user.php?id=<?=$dados['id_usuario']?>" method="POST">
        <p id="erro-senha" style="display: none; color: red;">As senhas não coincidem.</p>

        <fieldset>
            <legend>Nova Usuário</legend>

            <label>
                Nome: <input type="text" name="nome" value="<?=$dados['nome']?>"> 
            </label>
            <label>
                Email: <input type="email" name="email" value="<?=$dados['email']?>">
            </label>
            <label>
                Endereço: <input type="text" name="endereco" value="<?=$dados['endereco']?>">
            </label>
            <label>
                Cidade: <input type="text" name="cidade" value="<?=$dados['cidade']?>">
            </label>
            <label>
                Estado:
                <select name="estado" id="estado">
                    <option value="PR">Paraná</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="SP">São Paulo</option>
                </select>
            </label>
            <label>
                CEP: <input type="text" name="cep" value="<?=$dados['cep']?>">
            </label>
            <input type="submit" value="Cadastrar" name="envia">
        </fieldset>
    </form>
</body>

</html>