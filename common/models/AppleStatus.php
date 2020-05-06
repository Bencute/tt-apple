<?php


namespace common\models;


use Exception;

abstract class AppleStatus
{
    protected int $status;
    protected Apple $apple;

    /**
     * AppleStatus constructor.
     * @param int $status
     * @param Apple $apple
     */
    public function __construct(int $status, Apple $apple)
    {
        $this->status = $status;
        $this->apple = $apple;
    }

    public function __toString()
    {
        return (string) $this->status;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    public function isRot(): bool
    {
        return false;
    }

    public function fall(): void
    {
        throw new Exception('Недопустимое действие');
    }

    public function eat(int $percent): void
    {
        throw new Exception('Недопустимое действие');
    }

    public function throw(): void
    {
        throw new Exception('Недопустимое действие');
    }
}