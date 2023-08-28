<?php

require_once 'databaseConnection.php';

// Функция для загрузки записей блога
function loadPosts() {
    $url = 'https://jsonplaceholder.typicode.com/posts';
    $postsData = file_get_contents($url);
    $posts = json_decode($postsData, true);

    foreach ($posts as $post) {
        $query = "INSERT INTO posts (id, userId, title, body)
                  VALUES ('".$post['id']."', '".$post['userId']."', '".$post['title']."', '".$post['body']."')";
        $dbConnection = new DatabaseConnection();
        $dbConnection->executeQuery($query);
        $dbConnection->closeConnection();
    }
    return count($posts);
}

// Функция для загрузки комментариев
function loadComments() {
    $url = 'https://jsonplaceholder.typicode.com/comments';
    $commentsData = file_get_contents($url);
    $comments = json_decode($commentsData, true);

    foreach ($comments as $comment) {
        $query = "INSERT INTO comments (id, postId, name, email, body)
                  VALUES ('".$comment['id']."', '".$comment['postId']."', '".$comment['name']."', '".$comment['email']."', '".$comment['body']."')";
        $dbConnection = new DatabaseConnection();
        $dbConnection->executeQuery($query);
        $dbConnection->closeConnection();
    }

    return count($comments);
}

// Загрузка записей и комментариев
$postsCount = loadPosts();
$commentsCount = loadComments();

// Вывод результата в консоль
echo "Загружено ".$postsCount." записей и ".$commentsCount." комментариев\n";

?>
