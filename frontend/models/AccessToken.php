<?php

namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "accesstoken".
 *
 * @property int $accessTokenId
 * @property int $userId
 * @property string $accessToken
 * @property int $expiredAt
 *
 */
class AccessToken extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
     {
       //TODO переименовать таблицу на accessToken?
        return 'accesstoken';
    }

//    /**
//     * {@inheritdoc}
//     */
//    public function rules()
//    {
//        return [
//            [['userId', 'accessToken'], 'required'],
//            [['userId'], 'integer'],
//            [['accessToken'], 'string', 'max' => 255],
//            [['accessToken'], 'unique'],
//            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'userId']],
//        ];
//    }

//    /**
//     * Gets query for [[User]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getUser()
//    {
//        return $this->hasOne(User::className(), ['userId' => 'userId']);
//    }
    public function getUserId($token)
    {
        if (!$token) {
            throw new InvalidArgumentException('You must be logged in for this action');
        }
        return $this::findUser($token)['userId'];
    }

    static function findUser($token): AccessToken
    {
        return static::findOne(['accessToken' => $token]);
    }

    public function generateToken()
    {
        $this->accessToken = \Yii::$app->security->generateRandomString();
    }

}
