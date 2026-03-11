<?php

namespace app\models\generated;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 * @property int $created_at
 * @property bool $is_read
 */
class Message extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body', 'created_at'], 'required'],
            [['user_id'], 'integer'],
            [['body'], 'string'],
            [['created_at'], 'integer'],
            [['is_read'], 'boolean'],
            [['name', 'email', 'subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Użytkownik',
            'name' => 'Imię',
            'email' => 'Email',
            'subject' => 'Temat',
            'body' => 'Treść',
            'created_at' => 'Data utworzenia',
            'is_read' => 'Przeczytane',
        ];
    }

    /**
     * Get read property (alias for is_read)
     * @return bool
     */
    public function getRead()
    {
        return $this->is_read;
    }

    /**
     * Set read property
     * @param bool $value
     */
    public function setRead($value)
    {
        $this->is_read = $value;
    }

    /**
     * Get formatted date
     * @return string
     */
    public function getFormattedDate()
    {
        return date('Y-m-d H:i', $this->created_at);
    }

    /**
     * Get user relation
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\generated\User::class, ['id' => 'user_id']);
    }
}

