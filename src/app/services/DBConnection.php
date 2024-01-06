<?php

namespace App\Services;

use PDO;
use PDOException;

class DBConnection implements DBConnectionInterface
{
    public $connection;

    private ?string $dbDriver;
    private ?string $dbHost;
    private ?string $dbName;
    private ?string $dbUser;
    private ?string $dbPass;
    private ?int $dbPort;

    public function setConnectionData(array $formData): void
    {
        $formDataObject = (object) $formData;
        $this->dbDriver = $formDataObject->db_driver ?? '';
        $this->dbHost = $formDataObject->db_host ?? '';
        $this->dbName = $formDataObject->db_name ?? '';
        $this->dbUser = $formDataObject->db_user ?? '';
        $this->dbPass = $formDataObject->db_password ?? '';
        $this->dbPort = $formDataObject->db_port ?? '';
    }

    public function getConnection(): void
    {
        try {
            $this->connection = new PDO(
                sprintf('%s:host=%s:%d;dbname=%s', $this->dbDriver, $this->dbHost, $this->dbPort, $this->dbName),
                $this->dbUser,
                $this->dbPass
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getRows(string $query): array
    {
        try {
            if ($this->connection) {
                $queryStatement = $this->connection->prepare($query);
                $queryStatement->execute();
                $rows = $queryStatement->fetchAll(PDO::FETCH_ASSOC);
            }

            return $rows ?? [];
        } catch (PDOException $e) {
            return [
                'message'  => $e->getMessage()
            ];
        }
    }

    public function getDbAdapters(): array
    {
        return self::DB_ADAPTERS;
    }
}