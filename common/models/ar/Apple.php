<?php

namespace common\models\ar;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property string $date_create
 * @property string|null $date_fall
 * @property int $status
 * @property int $eat
 */
class Apple extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color'], 'required'],
            [['date_create', 'date_fall'], 'safe'],
            [['status', 'eat'], 'integer'],
            [['color'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
            'date_create' => 'Date Create',
            'date_fall' => 'Date Fall',
            'status' => 'Status',
            'eat' => 'Eat',
        ];
    }
}
