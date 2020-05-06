<?php


namespace common\models;


use Exception;

/**
 * Class Apple
 * @package common\models
 */
class Apple
{
    /**
     * Выкинуто
     */
    const STATUS_THROW = -1;

    /**
     * На дереве
     */
    const STATUS_TREE = 0;

    /**
     * Упавшее
     */
    const STATUS_FALL = 1;

    /**
     * Сгнившее
     */
    const STATUS_ROT = 2;

    /**
     * Съедено полностью
     */
    const STATUS_EATED = 3;

    /**
     * @var AppleStatus
     */
    private AppleStatus $status;

    /**
     * @var ar\Apple|string
     */
    private ar\Apple $arApple;

    /**
     * Apple constructor.
     * @param string|ar\Apple $conf
     */
    public function __construct($conf)
    {
        if (is_string($conf)) {
            $this->arApple = new ar\Apple(['color' => $conf]);
            $this->setStatus(self::STATUS_TREE);
        } elseif ($conf instanceof ar\Apple) {
            $this->arApple = $conf;
            $status = $this->getInstanceAppleStatus($this->arApple->getAttribute('status'));
            if ((string) $status != self::STATUS_FALL || !$status->isRot())
                $this->status = $status;
        }
    }

    /**
     * @throws Exception
     */
    private function saveAR(): void
    {
        $transaction = $this->arApple->getDb()->beginTransaction();
        try {
            if (!$this->arApple->save()){
                throw new Exception('Невозможно сохранить объект в базе. ' . var_export($this->arApple->getErrors(), true));
            }
            $transaction->commit();
        }
        catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    public function deleteAR(): void
    {
        $transaction = $this->arApple->getDb()->beginTransaction();
        try {
            $result = $this->arApple->delete();
            if ($result = 0 || $result === false) {
                throw new Exception('Невозможно удалить объект из базы');
            }
            $transaction->commit();
        }
        catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    private function applyChange(): void
    {
        $this->saveAR();
    }

    /**
     * @param int $statusId
     * @return AppleStatus
     */
    private function getInstanceAppleStatus(int $statusId): AppleStatus
    {
        switch ($statusId) {
            case self::STATUS_TREE:
                return new AppleStatusTree($statusId, $this);
            case self::STATUS_FALL:
                return new AppleStatusFall($statusId, $this);
            case self::STATUS_ROT:
                return new AppleStatusRot($statusId, $this);
            case self::STATUS_EATED:
                return new AppleStatusEated($statusId, $this);
            case self::STATUS_THROW:
                return new AppleStatusTrow($statusId, $this);
            default:
                new Exception('Неизвестное состояние');
        }
    }

    /**
     * @param int $statusId
     */
    public function setStatus(int $statusId): void
    {
        $this->status = $this->getInstanceAppleStatus($statusId);

        $this->setArAttribute('status', (string) $this->status);
    }

    /**
     * Упасть на землю
     */
    public function fall(): void
    {
        $this->status->fall();
    }

    /**
     * Съесть яблоко в процентах
     * @param int $percent
     * @throws Exception
     */
    public function eat(int $percent): void
    {
        $this->status->eat($percent);
    }

    /**
     * Выбросить яблоко
     *
     * @throws Exception
     */
    public function throw(): void
    {
        $this->status->throw();
    }

    /**
     * @return bool
     */
    public function isRot(): bool
    {
        return $this->status->isRot();
    }

    /**
     * @param int $percent
     */
    public function addEat(int $percent): void
    {
        $this->setArAttribute('eat', $this->getEat() + $percent);
    }

    /**
     * @return int
     */
    public function getEat(): int
    {
        return $this->arApple->eat;
    }

    /**
     * @return string|null
     */
    public function getDateFall(): ?string
    {
        return $this->arApple->date_fall;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->arApple->color;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->arApple->id;
    }

    /**
     * @param $date
     */
    public function setDateFall($date): void
    {
        $this->setArAttribute('date_fall', $date);
    }

    /**
     * @return string
     */
    public function getDateCreate(): string
    {
        return $this->arApple->date_create;
    }

    /**
     * @return AppleStatus
     */
    public function getStatus(): AppleStatus
    {
        return $this->status;
    }

    /**
     * @param string $nameAttribute
     * @param $value
     * @throws Exception
     */
    protected function setArAttribute(string $nameAttribute, $value): void
    {
        $this->arApple->$nameAttribute = $value;
        $this->applyChange();
    }

    /**
     * @return float
     */
    public function getSize(): float
    {
        $size = 1 - $this->getEat() / 100;
        return $size < 0 ? 0 : $size;
    }

    /**
     * @return string
     */
    public function getStringStatus(): string
    {
        switch ((string) $this->getStatus()) {
            case self::STATUS_THROW: return 'Выброшен';
            case self::STATUS_TREE: return 'На дереве';
            case self::STATUS_FALL: return 'На земле';
            case self::STATUS_ROT: return 'Испорчен';
            case self::STATUS_EATED: return 'Съеден';
        }
    }
}