<?php

require_once 'config.php';

try {
    $connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function searchUser($connection, $searchTerm, $isUsername = true)
{
    if ($isUsername) {
        $query = "SELECT * FROM user WHERE username = :searchTerm";
    } else {
        $query = "SELECT * FROM user WHERE id = :searchTerm";
    }

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':searchTerm', $searchTerm, $isUsername ? PDO::PARAM_STR : PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result;
    }

    return -1;
}

function createUser($connection, $username, $password)
{
    if (searchUser($connection, $username) !== -1) {
        echo "<p>Utilizador já existe</p>";
        return -1;
    }

    $query = "INSERT INTO user (username, password) VALUES (:username, :password)";
    $statement = $connection->prepare($query);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $password);
    try {
        $statement->execute();
        return 0;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return -1;
    }
}

function fetchItems($connection)
{
    $query = "SELECT * FROM animals";
    $arr = array();
    foreach ($connection->query($query) as $row) {
        array_push($arr, $row);
    }
    return $arr;
}

function addItem($nome, $image) {
    global $connection;

    $query = "INSERT INTO animals (nome, image) VALUES (:nome, :image)";
    $statement = $connection->prepare($query);
    $statement->bindParam(':nome', $nome);
    $statement->bindParam(':image', $image);

    try {
        $statement->execute();
        return 0;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return -1;
    }
}

function getAnimal($connection, $animal_id)
{
    $query = "SELECT * FROM animals WHERE id = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam(':id', $animal_id);
    $statement->execute();
    return $statement->fetch();
}

function getFacts($connection, $animal_id) {
    $query = 'SELECT * FROM user_animal WHERE animal_id = :animal_id';
    $statement = $connection->prepare($query);
    $statement->bindParam(':animal_id', $animal_id);
    $statement->execute();

    return $statement->fetch();
}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}