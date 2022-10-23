<?php

namespace App\Models;

class ClientData
{
    private string $name;
    private string $address;
    private string $description;
    private ?int $id;

    public function __construct(string $name, string $address, string $description, int $id = null)
    {
        $this->name = $name;
        $this->address = $address;
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

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
