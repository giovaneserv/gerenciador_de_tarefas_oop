    <?php
    include "conexao.php";
    class Usuario
    {
        
        public function Inserir($conexao, $nome, $email, $senha, $endereco, $cidade, $estado, $cep, $arquivo)

        {
            // Verifica se houve algum erro ao enviar o arquivo
            if ($arquivo['error']) {
                die("Falha ao enviar o arquivo");
            }
            // Verifica se o tamanho do arquivo excede um determinado limite (60MB)
            if ($arquivo['size'] > 60000000) {
                die("arquivo muito grande");
            }
            $conteudo_imagem = file_get_contents($arquivo['tmp_name']);

            $hash_imagem = hash('sha256', $conteudo_imagem);
            // Define o diretório de destino onde o arquivo será salvo
            $pasta = "imagens/";
            // Gera um nome de arquivo único para evitar conflitos de nome de arquivo
            $newFilename = uniqid();
            // Obtém a extensão do arquivo enviado
            $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
            // Verifica se a extensão do arquivo é uma extensão de imagem válida (jpg, png, jpeg)
            if ($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg") {
                die("Formato Inválido");
            }
            $caminho_imagem = $pasta . $newFilename.".".$extensao;
            if(!move_uploaded_file($arquivo['tmp_name'], $caminho_imagem)){
                die("Falha ao enviar o arquivo");
            }

            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $query = "INSERT INTO `usuarios`(`id_usuario`, `nome`, `email`, `senha`, `endereco`, `cidade`, `estado`, `cep`, `imagem`) VALUES (DEFAULT,'$nome','$email','$senha_hash','$endereco','$cidade','$estado','$cep','$caminho_imagem')";

            $resultado = mysqli_query($conexao->getConnection(), $query);

            if ($resultado) {
                return true;
            } else {
                return false;
            }
        }
    }
    /* Instanciar Connection importantissimo */
    $conexao = new Connection();
    $usuario = new Usuario($conexao);

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmar_senha'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $arquivo = $_FILES['arquivo'];

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        echo "Email Inválido";
    }
    if($senha !== $confirmarSenha){
        echo "As senhas tem que ser iguais";
    } else{
        
        // Chamar a função Inserir para inserir os dados no banco de dados
        if ($usuario->Inserir($conexao,$nome, $email, $senha, $endereco, $cidade, $estado, $cep, $arquivo)) {
            header("Location: form_usuario.html?mensagem=Inserção realizada com sucesso!");
        } else {
            echo "Erro ao inserir usuário.";
        }
    }