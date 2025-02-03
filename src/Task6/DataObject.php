<?php

declare(strict_types=1);

namespace Task\Task6;

class DataObject
{
    public function __construct(private int $id, private string $name, private string $type, private string $param)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
