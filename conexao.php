<?php

$pdo = \Alura\Pdo\Infrastructure\Persistence\ConnectionCreator::create();

echo 'Conectado!';

$pdo->exec('CREATE TABLE students (id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT);');
