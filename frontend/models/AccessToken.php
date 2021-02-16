<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "accesstoken".
 *
 * @property int $accessTokenId
 * @property int $userId
 * @property string $accessToken
 * @property int $expiredAt
 *
 * @property User $user
 */
class AccessToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accesstoken';
    }

    /**
     * {@inheritdoc}
     */
//    public function rules()
//    {
//        return [
//            [['userId', 'accessToken', 'expiredAt'], 'required'],
//            [['userId', 'expiredAt'], 'integer'],
//            [['accessToken'], 'string', 'max' => 255],
//            [['accessToken'], 'unique'],
//            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'userId']],
//        ];
//    }

    /**
     * {@inheritdoc}
     */
//    public function attributeLabels()
//    {
//        return [
//            'accessTokenId' => 'Access Token ID',
//            'userId' => 'User ID',
//            'accessToken' => 'Access Token',
//            'expiredAt' => 'Expired At',
//        ];
//    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
//    public function getUser()
//    {
//        return $this->hasOne(User::className(), ['userId' => 'userId']);
//    }


    public function generateToken($expire)
    {
        $this->expiredAt = $expire;
        $this->accessToken = \Yii::$app->security->generateRandomString();
    }

}
