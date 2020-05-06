<?php


namespace common\models;


/**
 * Trait AppleStatusThrowTrait
 * @package common\models
 */
trait AppleStatusThrowTrait
{
    /**
     * {@inheritDoc}
     */
    public function throw(): void
    {
        $this->apple->deleteAR();
        $this->apple->setStatus(Apple::STATUS_THROW);
    }
}