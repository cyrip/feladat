<?php

declare(strict_types=1);

namespace Task\Task5;

class QueryExtId
{
    private \PDO $pdo;

    public function __construct(private array $config)
    {
        $this->connect();
    }

    protected function connect(): void
    {
        $this->pdo = new \PDO($this->config['dsn'], $this->config['username'], $this->config['password']);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function run(): void
    {
        printf("\nRun Task5 ...\n");
        $sql = 'SELECT `column1`
                    FROM `test1`
                    WHERE LOWER(`column2`) = :column2';

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':column2', 'php');

        $stmt->execute();

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {

            $extId = $row['column1'];
    
            if (preg_match('/ExtId:(.*)(\d+)$/', $extId, $matches)) {
                printf("Response %s -> %s\n", $extId, $matches[1][mb_strlen($matches[1])-1] == 1 ? 'Success' : 'Unsuccessful');
            }
        }
    }
}

/*

CREATE TABLE `test1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `column1` varchar(255) DEFAULT NULL,
  `column2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4

*/