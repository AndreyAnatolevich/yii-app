<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $articleId
 * @property string|null $title
 * @property string|null $content
 * @property string|null $date
 * @property int|null $userId
 */
class BaseArticle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['date'], 'safe'],
            [['userId'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'articleId' => 'Article ID',
            'title' => 'Title',
            'content' => 'Content',
            'date' => 'Date',
            'userId' => 'User ID',
        ];
    }
}
