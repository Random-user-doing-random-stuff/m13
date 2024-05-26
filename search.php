<?php
session_start();
require_once "src/db/connection.php";
require_once 'menu/menu.php';

// Buscar factos com base no parâmetro de consulta
if (isset($_GET["q"])) {
    $facts = getFacts($connection, $_GET["q"]);
    $item = getTopic($connection, $_GET["q"]);
} else {
    // Lidar com parâmetro de consulta inválido ou ausente
}

if (isset($_POST["submit-edit"])) {
    $fact = $_POST["fact"];
    $fact_id = $_POST["fact_id"];
    $animal_id = $_GET["q"];
    $user_id = $_SESSION['user_row']['user_id'];
    editFact($connection, $fact, $fact_id);
    /* header("Refresh:0"); */
    $facts = getFacts($connection, $_GET["q"]);
}
if (isset($_POST["submit-fact"])) {
    $fact = $_POST["fact"];
    $animal_id = $_GET["q"];
    $user_id = $_SESSION['user_row']['user_id'];
    addFact($connection, $fact, $animal_id, $user_id);
    /* header("Refresh:0"); */
    $facts = getFacts($connection, $_GET["q"]);
    $_POST = [];
    header("Location: search.php?q=".$_GET["q"]); // Redirect to avoid duplicate submission
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tabela de factos</title>
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .editable {
            border: 1px solid #ccc;
            padding: 5px;
        }

        .non-editable {
            border: none;
            padding: 5px;
        }
    </style>
</head>

<body>
    <header>
        <div class="headsssss">
            <?php include 'themes/theme.php'; ?>
        </div>
    </header>
    <h1 class="title-search"><?php echo isset($item['name']) ? htmlspecialchars($item['name']) : 'Desconhecido'; ?></h1>
    <table>
        <tr>
            <th>Facto</th>
            <th>Utilizador</th>
            <th></th>
        </tr>
        <?php foreach ($facts as $fact): ?>
            <?php
            $user = searchUser($connection, $fact["user_id"], false);
            ?>
            <tr>
                <form method="post"
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?q=<?php echo htmlspecialchars($_GET['q']); ?>">
                    <td>
                        <div id="text-<?php echo $fact['fact_id']; ?>" class="non-editable" contenteditable="false">
                            <?php echo htmlspecialchars($fact["fact"]); ?>
                        </div>
                        <input type="hidden" name="fact" id="hiddenInput-<?php echo $fact['fact_id']; ?>"
                            value="<?php echo htmlspecialchars($fact["fact"]); ?>">
                        <input type="hidden" name="fact_id" value="<?php echo $fact['fact_id']; ?>">
                    </td>
                    <td><?php echo htmlspecialchars($user["username"]); ?></td>
                    <td>
                        <button type="button" id="toggleBtn-<?php echo $fact['fact_id']; ?>" class="edit-fact" <?php if ($user["user_id"] != $_SESSION['user_row']['user_id']) {
                               echo "disabled style='background-color: red; cursor: not-allowed;'";
                           } ?>>
                            Editar
                        </button>
                        <button type="submit" name="submit-edit" id="saveBtn-<?php echo $fact['fact_id']; ?>" class="edit-fact"
                            style="display: none;" <?php if ($user["user_id"] != $_SESSION['user_row']['user_id']) {
                                echo "disabled style='background-color: red; cursor: not-allowed;'";
                            } ?>>
                            Salvar
                        </button>
                    </td>


                </form>
            </tr>
        <?php endforeach; ?>
    </table>
    <button id="popoverBtn">Adicionar facto</button>

    <div id="popover" class="popover" style="display: none;">
        <form
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?q=<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>"
            method="post" enctype="multipart/form-data" class="popover-form">
            <label for="fact">Facto:</label><br>
            <input type="text" id="fact" name="fact" required><br>
            <div class="file-upload"></div>
            <div class="popover-button-container">
                <button type="submit" id="confirmBtn" name="submit-fact">Confirmar</button>
                <button type="button" id="cancelBtn">Cancelar</button>
            </div>
        </form>
    </div>

    <script>
        <?php foreach ($facts as $fact): ?>
            const textDiv<?php echo $fact['fact_id']; ?> = document.getElementById('text-<?php echo $fact['fact_id']; ?>');
            const toggleBtn<?php echo $fact['fact_id']; ?> = document.getElementById('toggleBtn-<?php echo $fact['fact_id']; ?>');
            const hiddenInput<?php echo $fact['fact_id']; ?> = document.getElementById('hiddenInput-<?php echo $fact['fact_id']; ?>');
            const saveBtn<?php echo $fact['fact_id']; ?> = document.getElementById('saveBtn-<?php echo $fact['fact_id']; ?>');


            toggleBtn<?php echo $fact['fact_id']; ?>.addEventListener('click', () => {
                if (textDiv<?php echo $fact['fact_id']; ?>.contentEditable === "true") {
                    textDiv<?php echo $fact['fact_id']; ?>.contentEditable = "false";
                    textDiv<?php echo $fact['fact_id']; ?>.classList.remove('editable');
                    textDiv<?php echo $fact['fact_id']; ?>.classList.add('non-editable');
                    hiddenInput<?php echo $fact['fact_id']; ?>.value = textDiv<?php echo $fact['fact_id']; ?>.textContent;
                    saveBtn<?php echo $fact['fact_id']; ?>.style.display = "none";
                    toggleBtn<?php echo $fact['fact_id']; ?>.style.display = "inline-block"; // Mostrar botão Editar
                } else {
                    textDiv<?php echo $fact['fact_id']; ?>.contentEditable = "true";
                    textDiv<?php echo $fact['fact_id']; ?>.classList.remove('non-editable');
                    textDiv<?php echo $fact['fact_id']; ?>.classList.add('editable');
                    saveBtn<?php echo $fact['fact_id']; ?>.style.display = "inline-block"; // Mostrar botão Salvar
                    toggleBtn<?php echo $fact['fact_id']; ?>.style.display = "none"; // Ocultar botão Editar
                }
            });
            saveBtn<?php echo $fact['fact_id']; ?>.addEventListener('click', () => {
                hiddenInput<?php echo $fact['fact_id']; ?>.value = textDiv<?php echo $fact['fact_id']; ?>.textContent.trim('');
            });
        <?php endforeach; ?>
    </script>
    <script src="main.js"></script>
</body>

</html>
