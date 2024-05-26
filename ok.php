<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editable Text Toggle with PHP</title>
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

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $textContent = $_POST['textContent'];
    // Log the text content (for demonstration, we are writing to a file)
    /* $logFile = 'text_log.txt';
    file_put_contents($logFile, $textContent . PHP_EOL, FILE_APPEND); */
    echo "<p>Text content: $textContent</p>";
}
?>

<form id="textForm" method="post" action="">
    <div id="text" class="non-editable" contenteditable="false">This is some text that can be edited.</div>
    <input type="hidden" id="hiddenInput" name="textContent">
    <button type="button" id="toggleBtn">Edit</button>
</form>

<script>
    const textDiv = document.getElementById('text');
    const toggleBtn = document.getElementById('toggleBtn');
    const hiddenInput = document.getElementById('hiddenInput');
    const textForm = document.getElementById('textForm');

    toggleBtn.addEventListener('click', () => {
        if (textDiv.contentEditable === "true") {
            textDiv.contentEditable = "false";
            textDiv.classList.remove('editable');
            textDiv.classList.add('non-editable');
            toggleBtn.textContent = "Edit";
            hiddenInput.value = textDiv.textContent; // Set hidden input value
            textForm.submit(); // Submit the form
        } else {
            textDiv.contentEditable = "true";
            textDiv.classList.remove('non-editable');
            textDiv.classList.add('editable');
            toggleBtn.textContent = "Save";
        }
    });
</script>

</body>
</html>
