<?php

namespace App\Models;

class ProductData
{
    private string $name;
    private string $type;
    private string $description;
    private ?int $id;

    public function __construct(string $name, string $type, string $description, int $id = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->description = $description;
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
