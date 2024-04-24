<?php
require"php/conexao.php";

$conexao = new Connection();
 session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <script src="https://kit.fontawesome.com/47e9777af5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/tabela.css">
</head>

<body>
    <h1>Listagem de Usuários</h1>
    <form action="" method="get">
        <label for="search">Pesquisar:
            <input type="text" name="search" id="search">
            <button type="submit">Consultar</button>
        </label>
    </form>

    <div class="msg">    
        <?php
        @$mensagem = $_GET["mensagem"];
        echo $mensagem;
        ?>
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>CEP</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <?php
        // mysqli_select_db($conexao, $bd);
        if (isset($_GET["search"]) && !empty($_GET["search"])) {
            $resultado = mysqli_real_escape_string($conexao->getConnection(), $_GET["search"]);
            $query = "SELECT * FROM usuarios WHERE
            nome LIKE '%$resultado%' OR
            email LIKE '%$resultado%' OR
            endereco LIKE '%$resultado%' OR
            cidade LIKE '%$resultado%' OR
            estado LIKE '%$resultado%' OR
            cep LIKE '%$resultado%'";

            $consulta = mysqli_query($conexao->getConnection(), $query);
        }else {
            // echo "realize uma pesquisa";
            $consulta = mysqli_query($conexao->getConnection(), "SELECT * FROM `usuarios`");
        }
        while ($dados = mysqli_fetch_assoc($consulta)) {
        ?>
        <tbody>
            <tr>
                <td><img src="<?=$dados['imagem']?>"></td>
                <td><?=$dados['id_usuario'];?></td>
                <td><?=$dados['nome'];?></td>
                <td><?=$dados['email'];?></td>
                <td><?=$dados['endereco'];?></td>
                <td><?=$dados['cidade'];?></td>
                <td><?=$dados['estado'];?></td>
                <td><?=$dados['cep'];?></td>
                <td><a href="edit_user.php?id=<?=$dados['id_usuario']?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a href="php/delete_user.php?id=<?=$dados['id_usuario']?>" onclick="verifica('<?=$dados['id_usuario']?>')"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
        </tbody>
        <?php } ?>
    </table>

    <script>
        function verifica(id){
            if (confirm("Tem certeza que deseja excluir o usuário?")) {
                window.location="php/delete_user.php?id_usuario="+id;
            }
        }
    </script>
</body>

</html>