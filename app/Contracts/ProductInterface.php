<?php

namespace App\Contracts;

interface ProductInterface
{
    public function getSku(): string;

    public function getDescription(): string;

    public function getPrice(): float;

    public function getCategoryId(): ?int; // nullable for optional category

    public function setSku(string $sku): void;

    public function setDescription(string $description): void;

    public function setPrice(float $price): void;

    public function setCategoryId(?int $categoryId): void; // nullable for optional category
}
