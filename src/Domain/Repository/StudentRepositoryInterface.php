<?php

namespace Alura\Pdo\Domain\Repository;

use Alura\Pdo\Domain\Model\Student;

interface StudentRepositoryInterface
{
    public function allStudents(): array;
    public function studentsWithPhones(): array;
    public function studentsBirthAt(\DateTimeImmutable $birthDate): array;
    public function save(Student $student): bool;
    public function remove(Student $student): bool;
}
