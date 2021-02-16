<?php

namespace frontend\controllers;

use Yii;
use frontend\models\LoginForm;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

class UserController extends ActiveController
{
    public $modelClass = 'frontend\models\UserSearch';

//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => HttpBasicAuth::className(),
//        ];
//        return $behaviors;
//    }

    public function actionList()
    {
        return [
            [
                'userId' => 1,
                'text' => 'test post',
            ],
        ];
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->auth()) {
            return $token;
        } else {
            return $model;
    }
    }
}