<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="php/processa_login.php" method="post">
        <label>Email:</label>
        <input type="email" name="email" id="email">
        <label>Senha:</label>
        <input type="password" name="senha" id="senha">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>