<?php
namespace common\components;

use common\models\Apple;
use Exception;

/**
 * Class AppleRepository
 * @package common\components
 */
class AppleRepository extends \yii\base\Component implements AppleRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function add(string $color): Apple
    {
        return new Apple($color);
    }

    /**
     * {@inheritDoc}
     */
    public function getById(int $id): Apple
    {
        $arApple = \common\models\ar\Apple::findOne($id);

        if (is_null($arApple))
            throw new Exception('Apple not found');

        return $this->assign($arApple);
    }

    /**
     * {@inheritDoc}
     */
    public function getAll(): array
    {
        $apples = [];
        foreach (\common\models\ar\Apple::find()->all() as $arApple) {
            $apples[] = $this->assign($arApple);
        }
        return $apples;
    }

    /**
     * @param \common\models\ar\Apple $arApple
     * @return Apple
     */
    private function assign(\common\models\ar\Apple $arApple): Apple
    {
        return new Apple($arApple);
    }

    /**
     * @param int $count
     * @return array
     */
    public function generateRandom(int $count = 3): array
    {
        $apples = [];
        for ($i = 0; $i < $count; $i++){
            $apples[] = $this->add($this->randomHexRgbColor());
        }
        return $apples;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function randomHexRgbColor(): string
    {
        return bin2hex(random_bytes(3));
    }
}