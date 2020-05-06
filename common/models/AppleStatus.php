<?php


namespace common\models;


use Exception;

/**
 * Class AppleStatus
 * @package common\models
 */
abstract class AppleStatus
{
    /**
     * @var int
     */
    protected int $status;

    /**
     * @var Apple
     */
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

    /**
     * @return string
     */
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

    /**
     * @return bool
     */
    public function isRot(): bool
    {
        return false;
    }

    /**
     * @throws Exception
     */
    public function fall(): void
    {
        throw new Exception('Недопустимое действие');
    }

    /**
     * @param int $percent
     * @throws Exception
     */
    public function eat(int $percent): void
    {
        throw new Exception('Недопустимое действие');
    }

    /**
     * @throws Exception
     */
    public function throw(): void
    {
        throw new Exception('Недопустимое действие');
    }
}