<?php


namespace common\models;


use Exception;

/**
 * Class Apple
 * @package common\models
 */
class Apple extends ar\Apple
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

    public AppleStatus $status;

    public string $color;

    /**
     * {@inheritdoc}
     */
    public function __construct(string $color, array $config = [])
    {
        $this->color = $color;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();


        if ($this->isNewRecord) {
            $this->setStatus(self::STATUS_TREE);
            $this->saveAR();
        } else {
            $this->setStatus($this->getAttribute('status'));
        }
    }

    public function setStatus(int $statusId): void
    {
        switch ($statusId) {
            case self::STATUS_TREE:
                $this->status = new AppleStatusTree($statusId, $this);
                break;
            case self::STATUS_FALL:
                $this->status = new AppleStatusFall($statusId, $this);
                break;
            case self::STATUS_ROT:
                $this->status = new AppleStatusRot($statusId, $this);
                break;
            case self::STATUS_EATED:
                $this->status = new AppleStatusEated($statusId, $this);
                break;
            case self::STATUS_THROW:
                $this->status = new AppleStatusTrow($statusId, $this);
                break;
            default:
                new Exception('Неизвестное состояние');
        }
    }

    /**
     * @throws Exception
     */
    private function saveAR(): void
    {
        $transaction = $this->getDb()->beginTransaction();
        try {
            if (!$this->save()){
                throw new Exception('Невозможно сохранить объект в базе');
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
        $transaction = $this->getDb()->beginTransaction();
        try {
            $result = $this->delete();
            if ($result !== false && $result > 0) {
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
     * Упасть на землю
     */
    public function fall(): void
    {
        $this->status->fall();
        $this->applyChange();
    }

    /**
     * Съесть яблоко в процентах
     * @param int $percent
     * @throws Exception
     */
    public function eat(int $percent): void
    {
        $this->status->eat($percent);
        $this->applyChange();
    }

    /**
     * Выбросить яблоко
     *
     * @throws Exception
     */
    public function throw(): void
    {
        $this->status->throw();
        $this->applyChange();
    }

    public function isRot(): bool
    {
        return $this->status->isRot();
    }
}