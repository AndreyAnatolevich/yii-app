<?php
namespace frontend\controllers;

use Yii;
use common\models\Article;
use yii\rest\Controller;
use frontend\models\AccessToken;

class ArticleController extends Controller
{


//TODO      API. Апи для публикации поста в блог
//      POST запрос
//      АПИ должно принимать входящие параметры:
//      accessToken
//      text - текст публикации
//      Система проверяет, есть ли в БД accessToken
//      По нему находит пользователя
//      И публикует пост в блог от имени найденного пользователя.


    public function actionCreate()
    {
        $request = Yii::$app->request->post();
        $token = new AccessToken();
        $article = new Article();
        $article->userId = $token->getUserId($request['accessToken']);
        $article->content = $request['text'];
            if($article->save()){
                return 'New article has been created';
            }
        return $article;
    }


//TODO      API. Апи для получения всех публикаций в системе
//      GET запрос
//      АПИ работает порционно
//      то есть за раз не должны возвращаться все записи в таблице, а только небольшая порция
//      АПИ должно принимать входящие параметры:
//      limit - сколько записей вернуть. Необязательное поле
//      offset - сколько записей ранее уже было загружено. Необязательное поле
//      Возвращает список сериализованных публикаций


    public function actionGetAll()
    {
        $request = Yii::$app->request->get();
        $deafultLimit = 5;
        $deafultOffset = 0;
        $limit = $request['limit'] ?? $deafultLimit;
        $offset = $request['offset'] ?? $deafultOffset;
        return Article::find()->limit($limit)->offset($offset)->all();

    }



//TODO      API. Апи для получения моих публикаций
//      GET запрос
//      АПИ работает порционно
//      то есть за раз не должны возвращаться все записи в таблице, а только небольшая порция
//      АПИ должно принимать входящие параметры:
//      limit - сколько записей вернуть. Необязательное поле
//      offset - сколько записей ранее уже было загружено. Необязательное поле
//      - Возвращает список сериализованных публикаций


    public function actionGetMy()
    {
        $request = Yii::$app->request->get();
        $deafultLimit = 5;
        $deafultOffset = 0;
        $limit = $request['limit'] ?? $deafultLimit;
        $offset = $request['offset'] ?? $deafultOffset;
        $token = new AccessToken();
        $article = new Article();
        $article->userId = $token->getUserId($request['accessToken']);
        if ($article->userId) {
            return Article::find()->where(['userId'=>$article->userId])->limit($limit)->offset($offset)->all();
        }
        return 'You must be logged in for this action';
    }
}