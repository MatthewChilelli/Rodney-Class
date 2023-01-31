<?php

function db() {

    $DB_HOST = 'mysql';
    $DB_NAME = getenv('MYSQL_DATABASE');
    $DB_USERNAME = getenv('MYSQL_USER');
    $DB_PASSWORD = getenv('MYSQL_PASSWORD');

    return new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USERNAME, $DB_PASSWORD);
}

function getPosts() {
    return db()->query('select * from posts order by created_at desc')->fetchAll(PDO::FETCH_ASSOC);
}

function getUserByUsername($username) {
    $stmt = db()->prepare('select * from users where username = :username');
    $stmt->execute(['username' => $username]);
    return $stmt->fetch();
}

function addPost($title, $content, $user_id) {
    $sql = 'insert into posts (title, content, user_id, created_at, updated_at) values (:title, :content, :user_id, now(), now())';
    $stmt = db()->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
}

function getFullPostData() {
    $query = mysql_query("select * from posts join username");
    return $query;
    echo "\n"  
}