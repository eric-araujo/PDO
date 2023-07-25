<?php

require_once 'vendor/autoload.php';

$connection = \Alura\Pdo\Infrastructure\Persistence\ConnectionCreator::create();

echo 'Conectado!';

$connection->exec(<<<SQL
    INSERT INTO phones(area_code, number, student_id) VALUES('11', '99999999', 1), ('11', '333333333', 1);
SQL);

// $createTableSql = <<<SQL
//     CREATE TABLE IF NOT EXISTS students (
//         id INTEGER PRIMARY KEY, 
//         name TEXT, 
//         birth_date TEXT
//     );

//     CREATE TABLE IF NOT EXISTS phones (
//         id INTEGER PRIMARY KEY,
//         area_code TEXT,
//         number TEXT,
//         student_id INTEGER,
//         FOREIGN KEY(student_id) REFERENCES students(id)
//     );
// SQL;

// $connection->exec($createTableSql);
