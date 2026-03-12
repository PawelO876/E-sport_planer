<?php

namespace app\models\extended;

use Yii;

class ContactForm extends \app\models\generated\ContactForm
{
    /**
     * Saves message to database
     * @return bool
     */
    public function saveMessage()
    {
        if ($this->validate()) {
            $message = new \app\models\extended\Message();
            $message->name = $this->name;
            $message->email = $this->email;
            $message->subject = $this->subject;
            $message->body = $this->body;
            $message->created_at = time();
            $message->is_read = false;
            if (!Yii::$app->user->isGuest) {
                $message->user_id = Yii::$app->user->id;
            }
            return $message->save();
        }
        return false;
    }
}
