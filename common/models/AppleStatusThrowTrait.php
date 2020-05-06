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
        $this->apple->setStatus(Apple::STATUS_THROW);
        $this->apple->deleteAR();
    }
}