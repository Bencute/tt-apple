<?php


namespace common\components;


use common\models\Apple;

/**
 * Interface AppleRepositoryInterface
 * @package common\components
 */
interface AppleRepositoryInterface
{
    /**
     * @param string $color
     * @return Apple
     */
    public function add(string $color): Apple;

    /**
     * @param int $id
     * @return Apple
     */
    public function getById(int $id): Apple;

    /**
     * @return array
     */
    public function getAll(): array;
}