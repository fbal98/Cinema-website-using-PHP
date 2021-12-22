<?php
    $dsn = 'mysql:host=localhost;dbname=theater';
    $username = 'theater_user';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
      } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>
