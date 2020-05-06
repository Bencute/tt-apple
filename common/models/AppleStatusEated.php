<?php


namespace common\models;


/**
 * Class AppleStatusEated
 * @package common\models
 */
class AppleStatusEated extends AppleStatus
{
    use AppleStatusThrowTrait;

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