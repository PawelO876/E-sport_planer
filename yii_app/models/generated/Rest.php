<?php

namespace app\models\generated;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "rest".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $rest_type
 * @property string|null $date
 */
class Rest extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['rest_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'rest_type' => 'Typ odpoczynku',
            'date' => 'Data',
        ];
    }
}
