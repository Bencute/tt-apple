<?php


namespace common\models;


/**
 * Class AppleStatusRot
 * @package common\models
 */
class AppleStatusRot extends AppleStatus
{
    use AppleStatusThrowTrait;

    /**
     * {@inheritDoc}
     */
    public function isRot(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    protected function next(): array
    {
        return [
            Apple::STATUS_THROW,
        ];
    }
}