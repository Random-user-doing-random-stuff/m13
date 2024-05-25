<?php
require_once 'src/db/connection.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_row'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit();
}

$row = $_SESSION['user_row']; // Use $row as needed

// Fetch items from the database
$items = fetchItems($connection);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $image = $_FILES['image']['name'] ?? null;
    $targetDir = "uploads/";

    // Ensure the uploads directory exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($image);

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        addItem($nome, $image);
        $_POST['nome'] = '';
        $_FILES['image']['name'] = null;
        header("Refresh:0");
    } else {
        $_POST['nome'] = '';
        $_FILES['image']['name'] = null;
        addItem($nome, null);
        header("Refresh:0");
        echo "Item added without image.";
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
                <input type="search" id="query" name="q" placeholder="Search..."
                    aria-label="Search through site content" onkeyup="filterItems()">
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
            <div class="card" data-nome="<?php echo htmlspecialchars($item['nome']); ?>"
                onclick="window.location.href='test.php?q=<?= $item['ID'] ?>'">
                <div class="card-inner">
                    <div class="card-front"
                        style="background-image: url('uploads/<?php echo htmlspecialchars($item['image']); ?>'); background-size: 100% 100%;">
                        <p>
                            <?php echo htmlspecialchars($item['nome']); ?>
                        </p>
                    </div>
                    <div class="card-back">
                        <p>
                            <?php echo getFacts($connection, $item['ID'])['fact'] ?? "null"; ?>
                        </p>
                        <div class="owner">
                            <?php
                            $facts = getFacts($connection, $item['ID']);
                            if ($facts && isset($facts['user_id'])) {
                                $owner = $facts['user_id'];
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


    <!--     <div class="form-container">
        <form action="main.php" method="post" enctype="multipart/form-data">
            <input type="text" name="nome" placeholder="Name" required>
            <input type="file" name="image" accept="image/*">
            <button type="submit" name="submit">Add Item</button>
        </form>
    </div>
     -->
     <button id="popoverBtn">Add</button>

<div id="popover" class="popover" style="display: none;">
    <form action="main.php" method="post" enctype="multipart/form-data" class="popover-form">
        <label for="nome">Name:</label><br>
        <input type="text" id="nome" name="nome" required><br>
        <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <div class="file-upload">
            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger('click')">Add Image</button>
            <div class="image-upload-wrap">
                <input class="file-upload-input" type='file' name="image" onchange="readURL(this);" accept="image/*" />
                <div class="drag-text">
                    <h3>Drag and drop a file or select add Image</h3>
                </div>
            </div>
            <div class="file-upload-content">
                <img class="file-upload-image" src="#" alt="your image" />
                <div class="image-title-wrap">
                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                </div>
            </div>
        </div>
        <div class="popover-button-container">
            <button type="submit" id="confirmBtn" name="submit">Confirm</button>
            <button type="button" id="cancelBtn">Cancel</button>
        </div>
    </form>
</div>


    <script src="main.js"></script>
</body>

</html>