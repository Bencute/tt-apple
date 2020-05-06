<?php


namespace common\models;


use Yii;

/**
 * Class AppleStatusFall
 * @package common\models
 */
class AppleStatusFall extends AppleStatus
{
    use AppleStatusThrowTrait;

    /**
     * Лимит лежания до порчи
     */
    const LIMIT_TIME_FALL = 18000;

    /**
     * Лимит в процентах до полного употребления
     */
    const LIMIT_EAT = 100;

    /**
     * {@inheritDoc}
     */
    public function isRot(): bool
    {
        if (time() - Yii::$app->formatter->asTimestamp($this->apple->getDateFall()) > self::LIMIT_TIME_FALL) {
            $this->apple->setStatus(Apple::STATUS_ROT);
            return $this->apple->getStatus()->isRot();
        }
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function eat(int $percent): void
    {
        $this->apple->addEat($percent);

        if ($this->apple->getEat() >= self::LIMIT_EAT) {
            $this->apple->setStatus(Apple::STATUS_EATED);
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function next(): array
    {
        return [
            Apple::STATUS_EATED,
            Apple::STATUS_THROW,
            Apple::STATUS_ROT,
        ];
    }
}