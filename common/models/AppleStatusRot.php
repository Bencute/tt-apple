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
}