<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$dataBasePath = __DIR__ . '/banco.sqlite';
$pdo = new \PDO(
    'sqlite:' . $dataBasePath
);

$student = new Student(null, 'Eric Lima', new \DateTimeImmutable('2000-10-25'));

$sqlInsert = <<<SQL
    INSERT INTO students(name, birth_date) VALUES('{$student->name()}', '{$student->birthDate()->format("Y-m-d")}')
SQL;

var_dump($pdo->exec($sqlInsert));