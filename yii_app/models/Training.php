<?php

namespace app\models;

use yii\db\ActiveRecord;

class Training extends ActiveRecord
{
    public static function tableName()
    {
        return 'trainings';
    }

    public function rules()
    {
        return [
            [['date', 'duration', 'game', 'training_type'], 'required'],
            [['date'], 'safe'],
            [['duration', 'user_id'], 'integer'],
            [['game', 'training_type'], 'string', 'max' => 255],
        ];
    }
}