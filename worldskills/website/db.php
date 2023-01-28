<?php
  $pdo = new PDO('mysql:host=localhost;dbname=personal_website;charset=utf8', 'root', 'root', [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);
?>