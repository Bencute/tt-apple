<?php


namespace common\models;


trait AppleStatusThrowTrait
{
    public function throw(): void
    {
        $this->apple->deleteAR();
        $this->apple->setStatus(Apple::STATUS_THROW);
    }
}