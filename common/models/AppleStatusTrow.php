<?php


namespace common\models;


use Exception;

class AppleStatusTrow extends AppleStatus
{
    public function isRot(): bool
    {
        throw new Exception('Состояние неизвестно');
    }
}