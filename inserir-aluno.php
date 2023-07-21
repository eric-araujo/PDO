<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$dataBasePath = __DIR__ . '/banco.sqlite';
$pdo = new \PDO(
    'sqlite:' . $dataBasePath
);

$student = new Student(
    null,
    "Roberta",
    new \DateTimeImmutable('1995-10-25')
);

$sqlInsert = <<<SQL
    INSERT INTO students(name, birth_date) VALUES(:name, :birth_date)
SQL;

$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(':name', $student->name());
$statement->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));

if (!$statement->execute()) {
    echo 'Falha ao incluir aluno';
}

echo 'Aluno Incluído';