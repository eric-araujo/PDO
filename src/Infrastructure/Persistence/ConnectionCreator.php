<?php

namespace Alura\Pdo\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function create(): PDO
    {
        $dataBasePath = __DIR__ . '/../../../banco.sqlite';

        return new \PDO(
            'sqlite:' . $dataBasePath
        );
    }
}
