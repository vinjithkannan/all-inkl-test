<?php

namespace App\Services;

interface DBConnectionInterface
{
    public const DB_ADAPTERS = [
        'cubrid' => 'CUBRID',
        'dblib' => 'DB LIB',
        'mysql' => 'MYSQL',
        'sqlsrv' => 'SQL SERVER ',
        'oci' => 'ORACLE',
        'pgsql' => 'POSTGRESQL',
        'sqlite' => 'SQL LITE',
        'odbc' => 'MS ACCESS'
    ];

    public function setConnectionData(array $formData): void;
    public function getConnection(): void;
    public function getRows(string $query): array;
    public function getDbAdapters(): array;
}