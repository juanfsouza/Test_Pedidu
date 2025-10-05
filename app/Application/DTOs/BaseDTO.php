<?php

namespace App\Application\DTOs;

abstract class BaseDTO
{
    protected array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function get(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function set(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }
}
