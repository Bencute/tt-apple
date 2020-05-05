<?php


namespace common\models;


class AppleStatusRot extends AppleStatus
{
    use AppleStatusThrowTrait;

    public function isRot(): bool
    {
        return true;
    }
}