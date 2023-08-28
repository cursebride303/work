<?php

require_once 'databaseConnection.php';

$queryText = $_GET['query'];

$query = "SELECT posts.title, comments.body
          FROM posts
          INNER JOIN comments ON posts.id = comments.postId
          WHERE comments.body LIKE CONCAT('%', ?, '%')";

$params = ['s', $queryText];

$dbConnection = new DatabaseConnection();
$results = $dbConnection->executeQuery($query, $params);

while ($row = $results->fetch_assoc()) {
    echo "<h3>".$row['title']."</h3>";
    echo "<p>".$row['body']."</p>";
}

$dbConnection->closeConnection();

?>
