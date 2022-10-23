<?php

namespace App\Services\Service;


use Carbon\Carbon;

class ServiceData
{
    private int $clientId;
    private int $productId;
    private int $price;
    private Carbon $date;
    private ?int $id;

    public function __construct(int $clientId, int $productId, int $price, Carbon $date, int $id = null)
    {
        $this->clientId = $clientId;
        $this->productId = $productId;
        $this->price = $price;
        $this->date = $date;
        $this->id = $id;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getDate(): Carbon
    {
        return $this->date;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
