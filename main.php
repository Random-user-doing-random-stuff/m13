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
    <title>home</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="light-mode">
    <header>
        <h2>
            HOME
        </h2>
        <input type="checkbox" class="checkbox" id="checkbox">
        <label for="checkbox" class="checkbox-label">
            <i class="fas fa-moon"></i>
            <i class="fas fa-sun"></i>
            <span class="ball"></span>
        </label>
    </header>



    <div class="card-container">
        <?php foreach ($items as $item): ?>
            <div class="card" onclick="window.location.href='test.php?q=<?= $item['ID'] ?>'">
                <div class="card-inner">
                    <div class="card-front"
                        style="background-image: url('uploads/<?php echo htmlspecialchars($item['image']); ?>'); background-size: 100% 100%;">
                        <p><?php echo htmlspecialchars($item['nome']); ?></p>
                    </div>
                    <div class="card-back">
                        <p><?php echo getFacts($connection, $item['ID'])['fact'] ?? "null"; ?></p>
                        <div class="owner">sergi</div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <form action="main.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nome" placeholder="Name" required>
        <input type="file" name="image" accept="image/*">
        <button type="submit" name="submit">Add Item</button>
    </form>
    <script src="main.js"></script>
</body>

</html>