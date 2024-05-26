<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    require_once 'menu/menu.php'; // Requer o arquivo 'menu/menu.php'
    require_once 'src/db/connection.php'; // Requer o arquivo 'src/db/connection.php'

    // Verifica se os dados foram enviados via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se o campo 'username' foi preenchido
        if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["cpassword"])) {
            $row = searchUser($connection, $_POST["username"]); // Chama a função 'searchUser' passando a conexão e o nome de utilizador como parâmetros
            if ($row != -1) {
                echo "<p class='error'>Utilizador ja existe</p>"; // Exibe uma mensagem de erro se o utilizador já existir
            } else {
                if (strcmp($_POST["password"], $_POST["cpassword"]) == 0) {
                    $status = createUser($connection, $_POST["username"], $_POST["password"]); // Chama a função 'createUser' passando a conexão, o nome de utilizador e a senha como parâmetros
                    echo $status == 0 ? "Utilizador criado com sucesso" : "Erro ao criar utilizador"; // Exibe "sim" se o utilizador for criado com sucesso, caso contrário, exibe "nao"
                }
            }
        } else {
            echo "<p class='error'>Username ou Password não foi preenchido!</p>"; // Exibe uma mensagem de erro se o nome de utilizador ou a senha não forem preenchidos
        }
    }
    ?>
    <header>
        <div class="headsssss">
            <?php include 'themes/theme.php'; ?> <!--   Inclui o arquivo 'themes/theme.php'-->
        </div>
    </header>
    <h2>Registar</h2> <!--   Título do formulário de registro-->
    <div class="container">
        <form method="post" class="form-registar">
            <p class="input-text">Username</p> <!--   Campo de entrada para o nome de utilizador-->
            <input type="text" name="username">
            <p class="input-text">Password</p> <!--   Campo de entrada para a senha-->
            <input type="password" name="password">
            <p class="input-text">Confirmar Password</p> <!--   Campo de entrada para confirmar a senha-->
            <input type="password" name="cpassword"> <br>

            <br> <input class="form-button" type="submit" value="Criar Conta"> <!--   Botão para criar a conta-->
        </form>
        <a class="register" href="login.php">Ja tenho conta</a> <!--   Link para a página de login-->
        <br>
        <br>
    </div>
</body>

</html>