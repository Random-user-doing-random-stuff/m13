<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    require_once 'src/db/connection.php';

    // Start the session
    session_start();

    // Verifica se os dados foram enviados via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se o campo 'username' foi preenchido
        if (!empty($_POST["username"]) && !empty($_POST["password"])) {
            $row = searchUser($connection, $_POST["username"]);
            if ($row == -1) {
                echo "<p>Utilizador não existe</p>";
            } else if(strcmp($_POST["username"], $row['username']) === 0 && strcmp($_POST["password"], $row['password']) === 0){
                // Store $row in session for later use
                $_SESSION['user_row'] = $row;
                echo "<p> Login efetuado com sucesso </p>";
                sleep(1);
                header("Location: main.php");
                exit(); // Make sure to exit after redirection
            } else {
                echo "<p class='error'>Password incorreta</p>";
            }
        } else {
            echo "<p class='error'>Username ou Password não foi preenchido!</p>";
        }
    }
    ?>
        <header>
            <div class="headsssss">
            <?php include 'themes/theme.php'; ?>
            </div>
        </header>
        <div class="container" >
        <h2>Login</h2>
        <form method="post" class="login">
            <p class="input-text">Username</p>
            <input type="text" name="username">
            <p class="input-text">Password</p>
            <input type="password" name="password"> <br>
            <br> <input class="form-button" type="submit" value="Login">
        </form>
        <a class="register" href="register.php">Registar</a>
        <br>
    </div>
</body>

</html>