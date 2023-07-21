<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$student = new Student(
    null,
    'Eric Lima',
    new \DateTimeImmutable('2000-10-25')
);

echo $student->age();
