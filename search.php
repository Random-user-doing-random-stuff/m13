<?php
session_start();
require_once "src/db/connection.php";
require_once 'menu/menu.php';

// Fetch facts based on the query parameter
if (isset($_GET["q"])) {
    $facts = getFacts($connection, $_GET["q"]);
    $item = getAnimal($connection, $_GET["q"]);
} else {
    // Handle invalid or missing query parameter
}

if (isset($_POST["submit-edit"])) {
    $fact = $_POST["fact"];
    $fact_id = $_POST["fact_id"];
    $animal_id = $_GET["q"];
    $user_id = $_SESSION['user_row']['id'];
    editFact($connection, $fact, $fact_id);
    /* header("Refresh:0"); */
    $facts = getFacts($connection, $_GET["q"]);
}
if (isset($_POST["submit-fact"])) {
    $fact = $_POST["fact"];
    $animal_id = $_GET["q"];
    $user_id = $_SESSION['user_row']['id'];
    addFact($connection, $fact, $animal_id, $user_id);
    /* header("Refresh:0"); */
    $facts = getFacts($connection, $_GET["q"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Facts Table</title>
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
    <h1 class="title-search"><?php echo isset($item['nome']) ? htmlspecialchars($item['nome']) : 'Unknown'; ?></h1>
    <table>
        <tr>
            <th>Facto</th>
            <th>User</th>
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
                        <div id="text-<?php echo $fact['ID']; ?>" class="non-editable" contenteditable="false">
                            <?php echo htmlspecialchars($fact["fact"]); ?>
                        </div>
                        <input type="hidden" name="fact" id="hiddenInput-<?php echo $fact['ID']; ?>"
                            value="<?php echo htmlspecialchars($fact["fact"]); ?>">
                        <input type="hidden" name="fact_id" value="<?php echo $fact['ID']; ?>">
                    </td>
                    <td><?php echo htmlspecialchars($user["username"]); ?></td>
                    <td>
                        <button type="button" id="toggleBtn-<?php echo $fact['ID']; ?>" class="edit-fact" <?php if ($user["id"] != $_SESSION['user_row']['id']) {
                               echo "disabled style='background-color: red; cursor: not-allowed;'";
                           } ?>>
                            Edit
                        </button>
                        <button type="submit" name="submit-edit" id="saveBtn-<?php echo $fact['ID']; ?>" class="edit-fact"
                            style="display: none;" <?php if ($user["id"] != $_SESSION['user_row']['id']) {
                                echo "disabled style='background-color: red; cursor: not-allowed;'";
                            } ?>>
                            Save
                        </button>
                    </td>


                </form>
            </tr>
        <?php endforeach; ?>
    </table>
    <button id="popoverBtn">Add fact</button>

    <div id="popover" class="popover" style="display: none;">
        <form
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?q=<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>"
            method="post" enctype="multipart/form-data" class="popover-form">
            <label for="fact">Fact:</label><br>
            <input type="text" id="fact" name="fact" required><br>
            <div class="file-upload"></div>
            <div class="popover-button-container">
                <button type="submit" id="confirmBtn" name="submit-fact">Confirm</button>
                <button type="button" id="cancelBtn">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        <?php foreach ($facts as $fact): ?>
            const textDiv<?php echo $fact['ID']; ?> = document.getElementById('text-<?php echo $fact['ID']; ?>');
            const toggleBtn<?php echo $fact['ID']; ?> = document.getElementById('toggleBtn-<?php echo $fact['ID']; ?>');
            const hiddenInput<?php echo $fact['ID']; ?> = document.getElementById('hiddenInput-<?php echo $fact['ID']; ?>');
            const saveBtn<?php echo $fact['ID']; ?> = document.getElementById('saveBtn-<?php echo $fact['ID']; ?>');


            toggleBtn<?php echo $fact['ID']; ?>.addEventListener('click', () => {
                if (textDiv<?php echo $fact['ID']; ?>.contentEditable === "true") {
                    textDiv<?php echo $fact['ID']; ?>.contentEditable = "false";
                    textDiv<?php echo $fact['ID']; ?>.classList.remove('editable');
                    textDiv<?php echo $fact['ID']; ?>.classList.add('non-editable');
                    hiddenInput<?php echo $fact['ID']; ?>.value = textDiv<?php echo $fact['ID']; ?>.textContent;
                    saveBtn<?php echo $fact['ID']; ?>.style.display = "none";
                    toggleBtn<?php echo $fact['ID']; ?>.style.display = "inline-block"; // Show Edit button
                } else {
                    textDiv<?php echo $fact['ID']; ?>.contentEditable = "true";
                    textDiv<?php echo $fact['ID']; ?>.classList.remove('non-editable');
                    textDiv<?php echo $fact['ID']; ?>.classList.add('editable');
                    saveBtn<?php echo $fact['ID']; ?>.style.display = "inline-block"; // Show Save button
                    toggleBtn<?php echo $fact['ID']; ?>.style.display = "none"; // Hide Edit button
                }
            });
            saveBtn<?php echo $fact['ID']; ?>.addEventListener('click', () => {
                hiddenInput<?php echo $fact['ID']; ?>.value = textDiv<?php echo $fact['ID']; ?>.textContent.trim('');
            });



        <?php endforeach; ?>
    </script>
    <script src="main.js"></script>
</body>

</html>