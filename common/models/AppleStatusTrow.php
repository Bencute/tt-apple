<?php


namespace common\models;


use Exception;

/**
 * Class AppleStatusTrow
 * @package common\models
 */
class AppleStatusTrow extends AppleStatus
{
    /**
     * {@inheritDoc}
     *
     * @throws Exception
     */
    public function isRot(): bool
    {
        throw new Exception('Состояние неизвестно');
    }
}