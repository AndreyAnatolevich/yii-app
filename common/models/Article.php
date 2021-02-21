<?php

namespace common\models;


/**
 * This is the model class for table "article".
 *
 * @property int $articleId
 * @property string|null $title
 * @property string|null $content
 * @property string|null $date
 * @property int|null $userId
 */
class Article extends BaseArticle
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['content', 'userId'], 'required'],
            [['date'], 'default', 'value' => date("Y-m-d H:i:s")],
        ]);
    }


    public function serializeToArray()
    {
        $data = [];
        $authorUser = User::findOne(['userId' => $this->userId])->username;

        $data['author'] = $authorUser;
        $data['title'] = $this->title;
        $data['content'] = $this->content;
        $data['created'] = $this->date;

        return $data;
    }


}