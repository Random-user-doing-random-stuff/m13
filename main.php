<?php
require_once 'src/db/connection.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_row'])) {
    // Redireciona o usuário para a página de login se não estiver logado
    /* header("Location: login.php");
     */
    exit();
}

$row = $_SESSION['user_row']; // Use $row conforme necessário

// Busca itens no banco de dados
$items = fetchItems($connection);

// Manipula o envio do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (!empty($_POST["name"])) {
        $name = $_POST['name'];
        $image = $_FILES['image']['name'] ?? null;
        $targetDir = "uploads/";

        // Garante que o diretório de uploads exista
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($image);

        // Move o arquivo enviado para o diretório de destino
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            addItem($name, $image);
            $_POST['name'] = '';
            $_FILES['image']['name'] = null;
            header("Refresh:0");

        } else {
            $_POST['name'] = '';
            $_FILES['image']['name'] = null;
            addItem($name, null);
            header("Refresh:0");

            echo "Item adicionado sem imagem.";
        }
    } else {
        echo "O campo Nome não pode estar vazio!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="global.css">
</head>

<body class="light-mode">

    <?php include 'menu/menu.php'; ?>

    <header>
        <div class="headsssss">
            <form role="search" id="form">
                <input type="search" id="query" name="q" placeholder="Pesquisar..."
                    aria-label="Pesquisar conteúdo do site" onkeyup="filterItems()">
                <button type="button">
                    <svg viewBox="0 0 1024 1024">
                        <path class="path1"
                            d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z">
                        </path>
                    </svg>
                </button>
            </form>
            <?php include 'themes/theme.php'; ?>
        </div>
    </header>

    <div class="card-container" id="cardContainer">
        <?php foreach ($items as $item): ?>
            <div class="card" data-name="<?php echo htmlspecialchars($item['name']); ?>"
                onclick="window.location.href='search.php?q=<?= $item['topic_id'] ?>'">
                <div class="card-inner">
                    <div class="card-front"
                        style="background-image: url('uploads/<?php echo htmlspecialchars($item['image']); ?>'); background-size: 100% 100%;">
                        <p>
                            <?php echo htmlspecialchars($item['name']); ?>
                        </p>
                    </div>
                    <div class="card-back">
                        <p>
                            <?php
                            $facts = getFacts($connection, $item['topic_id']);
                            $randomIndex = $facts ? rand(0, count($facts) - 1) : null;
                            $randomFact = $facts ? $facts[$randomIndex]['fact'] : "null";
                            echo $randomFact;
                            ?>
                        </p>
                        <div class="owner">
                            <?php
                            if ($facts && isset($facts[$randomIndex]['user_id'])) {
                                $owner = $facts[$randomIndex]['user_id'];
                                $user = searchUser($connection, $owner, false);
                                $username = $user ? $user['username'] : "null";
                            } else {
                                $username = "null";
                            }
                            echo $username;
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="button-container">
        <button onclick="location.reload()" class="reload-button"><svg width="800px" height="800px" viewBox="0 0 15 15"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M1.84998 7.49998C1.84998 4.66458 4.05979 1.84998 7.49998 1.84998C10.2783 1.84998 11.6515 3.9064 12.2367 5H10.5C10.2239 5 10 5.22386 10 5.5C10 5.77614 10.2239 6 10.5 6H13.5C13.7761 6 14 5.77614 14 5.5V2.5C14 2.22386 13.7761 2 13.5 2C13.2239 2 13 2.22386 13 2.5V4.31318C12.2955 3.07126 10.6659 0.849976 7.49998 0.849976C3.43716 0.849976 0.849976 4.18537 0.849976 7.49998C0.849976 10.8146 3.43716 14.15 7.49998 14.15C9.44382 14.15 11.0622 13.3808 12.2145 12.2084C12.8315 11.5806 13.3133 10.839 13.6418 10.0407C13.7469 9.78536 13.6251 9.49315 13.3698 9.38806C13.1144 9.28296 12.8222 9.40478 12.7171 9.66014C12.4363 10.3425 12.0251 10.9745 11.5013 11.5074C10.5295 12.4963 9.16504 13.15 7.49998 13.15C4.05979 13.15 1.84998 10.3354 1.84998 7.49998Z"
                    fill="#fff" />
            </svg></button>
        <button id="popoverBtn">Adicionar</button>
        <div id="popover" class="popover" style="display: none;">
            <form action="main.php" method="post" enctype="multipart/form-data" class="popover-form">
                <label for="name">Nome:</label><br>
                <input type="text" id="name" name="name" required><br>
                <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
                <div class="file-upload">
                    <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger('click')">Adicionar
                        Imagem</button>
                    <div class="image-upload-wrap">
                        <input class="file-upload-input" type='file' name="image" onchange="readURL(this);"
                            accept="image/*" />
                        <div class="drag-text">
                            <h3>Arraste e solte um ficheiro ou selecione para adicionar uma imagem</h3>
                        </div>
                    </div>
                    <div class="file-upload-content">
                        <img class="file-upload-image" src="#" alt="sua imagem" />
                        <div class="image-title-wrap">
                            <button type="button" onclick="removeUpload()" class="remove-image">Remover <span
                                    class="image-title">Imagem enviada</span></button>
                        </div>
                    </div>
                </div>
                <div class="popover-button-container">
                    <button type="submit" id="confirmBtn" name="submit">Confirmar</button>
                    <button type="button" id="cancelBtn">Cancelar</button>
                </div>
            </form>
        </div>
    </div>


    <script src="main.js"></script>
</body>

</html>
