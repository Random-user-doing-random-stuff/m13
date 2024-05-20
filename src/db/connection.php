<?php

require_once 'config.php';

try {
    $connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function searchUser($connection, $username = "")
{
    $query = "SELECT * FROM user";
    foreach ($connection->query($query) as $row) {
        if (strcmp($row['username'], $username) === 0) {
            return $row;
        }
    }
    return -1;
}

function createUser($connection, $username, $password)
{
    if (searchUser($connection, $username) !== -1) {
        echo "<p>Utilizador já existe</p>";
        return -1;
    }

    $query = "INSERT INTO user (username, `password`) VALUES (:username, :`password`)";
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

function addItem($nome, $desc, $image) {
    global $connection;

    $query = "INSERT INTO animals (nome, `desc`, image) VALUES (:nome, :desc, :image)";
    $statement = $connection->prepare($query);
    $statement->bindParam(':nome', $nome);
    $statement->bindParam(':desc', $desc);
    $statement->bindParam(':image', $image);

    try {
        $statement->execute();
        return 0;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return -1;
    }
}
