<?php


namespace common\models;


class AppleStatusFall extends AppleStatus
{
    use AppleStatusThrowTrait;

    public function isRot(): bool
    {
        if ($this->apple->date_fall - $this->apple->date_create > 18000) {
            $this->apple->setStatus(Apple::STATUS_ROT);
            return $this->apple->status->isRot();
        }
        return false;
    }

    public function eat(int $percent): void
    {
        $this->apple->eat += $percent;

        if ($this->apple->eat >= 100) {
            $this->apple->setStatus(Apple::STATUS_EATED);
        }
    }
}