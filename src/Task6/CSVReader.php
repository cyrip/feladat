<?php

declare(strict_types=1);

namespace Task\Task6;

use Task\Task6\DataRepository;
use Task\Task6\DataObject;

class CSVReader
{
    const DATA_FILE_NAME = './data/data.csv';

    private $handle;

    public function __construct(private DataRepository $repository)
    {
        $this->open();
    }

    protected function open(): void
    {
        $this->handle = fopen(self::DATA_FILE_NAME, "r");
        if (!$this->handle) {
            throw new \Exception("Can't open " . self::DATA_FILE_NAME);
        }
    }

    public function read(): self
    {
        fgetcsv($this->handle); // we dont need the header now
        while (($data = fgetcsv($this->handle)) !== false) {
            // we need some validation but I don't do that now
            $id = (int) $data[0];
            $this->repository->offsetSet($id, new DataObject($id, $data[1], $data[2], $data[3]));
        }
        return $this;
    }

    public function list(): self
    {
        // get the repository
        foreach($this->repository as $data) {
            printf("Id: %d, name: %s\n", $data->getId(), $data->getName());
        }

        // get a dataObject with an Id
        $data = $this->repository->offsetGet(1);
        printf("\nId: %d, name: %s\n", $data->getId(), $data->getName());

        return $this;
    }

    public function run(): void
    {
       printf("\nRun Task6 ...\n");   
       $this->read();
       $this->list();
    }
}
