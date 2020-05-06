<?php


namespace common\models;


use yii\db\Expression;

/**
 * Class AppleStatusTree
 * @package common\models
 */
class AppleStatusTree extends AppleStatus
{
    /**
     * {@inheritDoc}
     */
    public function fall(): void
    {
        $this->apple->setStatus(Apple::STATUS_FALL);
        $this->apple->setDateFall(new Expression('NOW()'));
    }

    /**
     * {@inheritDoc}
     */
    protected function next(): array
    {
        return [
            Apple::STATUS_FALL,
        ];
    }
}