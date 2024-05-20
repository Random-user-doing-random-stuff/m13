<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<?php
    require_once 'src/db/connection.php';
    // Verifica se os dados foram enviados via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se o campo 'username' foi preenchido
        if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["cpassword"])) {
            $row = searchUser($connection, $_POST["username"]);
            if($row != -1) {
                echo "<p>Utilizador ja existe</p>";
            } else {
               if(strcmp($_POST["password"], $_POST["cpassword"]) == 0) {
                    $status = createUser($connection, $_POST["username"], $_POST["password"]);
                    echo $status == 0 ?  "sim" : "nao";
               }
            }
        } else {
            echo "<p class='error'>Username ou Password não foi preenchido!</p>";
        }
    }
    ?>
    <h2>Registar</h2>
    <div class="container">
        <form method="post" class="form-registar">
            <p class="input-text">Username</p>
            <input type="text" name="username">
            <p class="input-text">Password</p>
            <input type="password" name="password">
            <p class="input-text">Confirmar Password</p>
            <input type="password" name="cpassword"> <br>

            <br> <input class="form-button" type="submit" value="Criar Conta">
        </form>
        <a class="register" href="login.php">Ja tenho conta</a>
        <br>
        <br>
    </div>
</body>

</html>