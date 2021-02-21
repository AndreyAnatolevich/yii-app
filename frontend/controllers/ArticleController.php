<?php

namespace frontend\controllers;

use Yii;
use common\models\Article;
use yii\rest\Controller;
use frontend\models\AccessToken;
use yii\base\InvalidArgumentException;

class ArticleController extends Controller
{


    /**
     *  API. Апи для публикации поста в блог
     *POST запрос
     *АПИ должно принимать входящие параметры:
     *    accessToken
     *    text - текст публикации
     *Система проверяет, есть ли в БД accessToken
     *По нему находит пользователя
     *И публикует пост в блог от имени найденного пользователя.
     */

    public function actionCreate()
    {
        $request = Yii::$app->request->post();
        $token = new AccessToken();
        $article = new Article();

        try {
            $article->userId = $token->getUserId($request['accessToken']);
        } catch (InvalidArgumentException $e) {
            return array('field' => 'accessToken', 'message' => $e->getMessage());
        }

        $article->content = $request['text'];
        if ($article->save()) {
            return array('message' => 'New article has been created');
        }
        return $article;
    }


    /**
     *  API. Апи для получения всех публикаций в системе
     *GET запрос
     *АПИ работает порционно
     *то есть за раз не должны возвращаться все записи в таблице, а только небольшая порция
     *АПИ должно принимать входящие параметры:
     *    limit - сколько записей вернуть. Необязательное поле
     *    offset - сколько записей ранее уже было загружено. Необязательное поле
     *- Возвращает список сериализованных публикаций
     */

    public function actionGetAll()
    {
        $request = Yii::$app->request->get();
        $data = [];
        $defaultLimit = 5;
        $defaultOffset = 0;
        $limit = $request['limit'] ?? $defaultLimit;
        $offset = $request['offset'] ?? $defaultOffset;
        $query = Article::find()->limit($limit)->offset($offset);
        foreach ($query->each() as $post) {
            $data[] = $post->serializeToArray();
        }
        return $data;
    }


    /**
     *  API. Апи для получения моих публикаций
     *GET запрос
     *АПИ работает порционно
     *то есть за раз не должны возвращаться все записи в таблице, а только небольшая порция
     *АПИ должно принимать входящие параметры:
     *    limit - сколько записей вернуть. Необязательное поле
     *    offset - сколько записей ранее уже было загружено. Необязательное поле
     *- Возвращает список сериализованных публикаций
     */

    public function actionGetMy()
    {
        $request = Yii::$app->request->get();
        $data = [];
        $defaultLimit = 5;
        $defaultOffset = 0;
        $limit = $request['limit'] ?? $defaultLimit;
        $offset = $request['offset'] ?? $defaultOffset;
        $token = new AccessToken();
        $article = new Article();

        try {
            $article->userId = $token->getUserId($request['accessToken']);
        } catch (InvalidArgumentException $e) {
            return array('field' => 'accessToken', 'message' => $e->getMessage());
        }

        $query = Article::find()->where(['userId' => $article->userId])->limit($limit)->offset($offset);
        foreach ($query->each() as $post) {
            $data[] = $post->serializeToArray();
        }
        return $data;
    }
}