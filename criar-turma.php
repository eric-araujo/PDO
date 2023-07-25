<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Repository\StudentRepositoryPDO;

require_once 'vendor/autoload.php';

$connection = \Alura\Pdo\Infrastructure\Persistence\ConnectionCreator::create();

$studentRepository = new StudentRepositoryPDO($connection);

$connection->beginTransaction();

$student = new Student(
    null,
    'Rodolfo Nilo',
    new \DateTimeImmutable('1998-09-20')
);

$studentRepository->save($student);

$student = new Student(
    null,
    'Sergio Douglas',
    new \DateTimeImmutable('1994-10-23')
);

$studentRepository->save($student);

// $connection->rollBack();

$connection->commit();