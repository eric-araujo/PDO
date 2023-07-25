<?php

use Alura\Pdo\Infrastructure\Repository\StudentRepositoryPDO;

require_once 'vendor/autoload.php';

$connection = \Alura\Pdo\Infrastructure\Persistence\ConnectionCreator::create();
$repository = new StudentRepositoryPDO($connection);

/** @var \Alura\Pdo\Domain\Model\Student[] $studentList */
$studentList = $repository->studentsWithPhones();

echo $studentList[1]->phones()[0]->formattedPhone();