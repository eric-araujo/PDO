<?php

namespace Alura\Pdo\Infrastructure\Repository;

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\StudentRepositoryInterface;
use PDO;

class StudentRepositoryPDO implements StudentRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function allStudents(): array
    {
        $statement = $this->connection->query(<<<SQL
            SELECT * FROM students;
        SQL);

        return $this->hydrateStudentList($statement);
    }

    public function studentsBirthAt(\DateTimeImmutable $birthDate): array
    {
        $statement = $this->connection->prepare(<<<SQL
            SELECT * FROM students WHERE birth_date = ?;
        SQL);
        $statement->bindValue(1, $birthDate->format('Y-m-d'));
        $statement->execute();

        return $this->hydrateStudentList($statement);
    }

    private function hydrateStudentList(\PDOStatement $pdoStatement): array
    {
        $studentDataList = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new \DateTimeImmutable($studentData['birth_date'])
            );
        }

        return $studentList;
    }

    public function save(Student $student): bool
    {
        if (is_null($student->id())) {
            return $this->insert($student);
        }

        return $this->update($student);
    }

    private function insert(Student $student): bool
    {
        $sqlInsert = <<<SQL
            INSERT INTO students(name, birth_date) VALUES(:name, :birth_date)
        SQL;

        $statement = $this->connection->prepare($sqlInsert);

        $success = $statement->execute([
            ':name' => $student->name(),
            ':birth_date' => $student->birthDate()->format('Y-m-d')
        ]);

        if ($success) {
            $student->defineId($this->connection->lastInsertId());
        }

        return $success;
    }

    private function update(Student $student): bool
    {
        $sqlUpdate = <<<SQL
            UPDATE students
            SET name = :name, birth_date = :birth_date
            WHERE id = :id
        SQL;

        $statement = $this->connection->prepare($sqlUpdate);
        $statement->bindValue(':name', $student->name());
        $statement->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));
        $statement->bindValue(':id', $student->id(), PDO::PARAM_INT);

        return $statement->execute();
    }

    public function remove(Student $student): bool
    {
        $preparedStatement = $this->connection->prepare(<<<SQL
            DELETE FROM students WHERE id = ?;
        SQL);
        $preparedStatement->bindValue(1, $student->id(), PDO::PARAM_INT);

        return $preparedStatement->execute();
    }
}
