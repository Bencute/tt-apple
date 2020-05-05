<?php


namespace common\models;


use Exception;
use yii\db\Expression;

class AppleStatusTree extends AppleStatus
{
    public function fall(): void
    {
        $this->apple->setStatus(Apple::STATUS_FALL);
        $this->apple->date_fall = new Expression('NOW()');
    }
}