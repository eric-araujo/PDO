<?php

require_once 'vendor/autoload.php';

$pdo = \Alura\Pdo\Infrastructure\Persistence\ConnectionCreator::create();

$preparedStatement = $pdo->prepare(<<<SQL
    DELETE FROM students WHERE id = ?;
SQL);
$preparedStatement->bindValue(1, 2, PDO::PARAM_INT);
$preparedStatement->execute();

$preparedStatement->bindValue(1, 3, PDO::PARAM_INT);
$preparedStatement->execute();
