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
    // Verifica se o termo de pesquisa é um nome de usuário ou um ID
    if ($isUsername) {
        $query = "SELECT * FROM users WHERE username = :searchTerm";
    } else {
        $query = "SELECT * FROM users WHERE user_id = :searchTerm";
    }

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':searchTerm', $searchTerm, $isUsername ? PDO::PARAM_STR : PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Retorna o resultado da pesquisa ou -1 se não encontrado
    if ($result) {
        return $result;
    }

    return -1;
}

function createUser($connection, $username, $password)
{
    // Verifica se o usuário já existe antes de criar um novo
    if (searchUser($connection, $username) !== -1) {
        echo "<p>Utilizador já existe</p>";
        return -1;
    }

    $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
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
    // Retorna todos os itens da tabela "topics"
    $query = "SELECT * FROM topics";
    $arr = array();
    foreach ($connection->query($query) as $row) {
        array_push($arr, $row);
    }
    return $arr;
}

function addItem($name, $image)
{
    global $connection;

    // Adiciona um novo item à tabela "topics"
    $query = "INSERT INTO topics (name, image) VALUES (:name, :image)";
    $statement = $connection->prepare($query);
    $statement->bindParam(':name', $name);
    $statement->bindParam(':image', $image);

    try {
        $statement->execute();
        return 0;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return -1;
    }
}

function getTopic($connection, $topic_id)
{
    // Retorna as informações de um tópico com base no ID
    $query = "SELECT * FROM topics WHERE topic_id = :topic_id";
    $statement = $connection->prepare($query);
    $statement->bindParam(':topic_id', $topic_id);
    $statement->execute();
    return $statement->fetch();
}

function getFacts($connection, $topic_id)
{
    // Retorna todos os factos relacionados a um tópico específico
    $query = 'SELECT * FROM user_topic_facts WHERE topic_id = :topic_id';
    $statement = $connection->prepare($query);
    $statement->bindParam(':topic_id', $topic_id);
    $statement->execute();

    return $statement->fetchAll();
}

function addFact($connection, $fact, $topic_id, $user_id)
{
    // Adiciona um novo facto relacionado a um tópico e usuário específicos
    $query = "INSERT INTO user_topic_facts (fact, topic_id, user_id) VALUES (:fact, :topic_id, :user_id)";
    $statement = $connection->prepare($query);
    $statement->bindParam(':fact', $fact);
    $statement->bindParam(':topic_id', $topic_id);
    $statement->bindParam(':user_id', $user_id);

    try {
        $statement->execute();
        return 0;
    } catch (PDOException $e) {
        if ($e->getCode() == 23000 && strpos($e->getMessage(), 'Duplicate entry') !== false) {
            echo "Error: Fact already exists for this topic and user.";
        } else {
            echo "Error: " . $e->getMessage();
        }
        return -1;
    }
}

function editFact($connection, $new_fact, $fact_id)
{
    // Edita um facto existente com base no ID do facto
    $query = "UPDATE user_topic_facts SET fact = :fact WHERE fact_id = :fact_id";
    $statement = $connection->prepare($query);
    $statement->bindParam(':fact', $new_fact);
    $statement->bindParam(':fact_id', $fact_id);

    try {
        $statement->execute();
        return 0;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return -1;
    }
}

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>
