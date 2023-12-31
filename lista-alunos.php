<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Repository\StudentRepositoryPDO;

require_once 'vendor/autoload.php';

$connection = \Alura\Pdo\Infrastructure\Persistence\ConnectionCreator::create();

$repository = new StudentRepositoryPDO($connection);
$studentList = $repository->allStudents();

var_dump($studentList);