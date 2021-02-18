<?php

namespace frontend\controllers;

use Yii;
use frontend\models\LoginForm;
use yii\rest\Controller;
use common\models\User;
use frontend\models\AccessToken;

class UserController extends Controller
{

    /**
     * API. Апи для регистрации пользователя
     * АПИ должно принимать входящие параметры и регистрировать пользователя
     * Имя
     * Email
     * Пароль
     * Возвращает accessToken или ошибку
     */

    public function actionSingup()
    {
        $request = Yii::$app->request->bodyParams;
        $user = new User();
        $user->username = $request['username'];
        $user->email = $request['email'];
        $token = new AccessToken();
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword($request['password']);
        $user->generateAuthKey();
        if ($user->save()) {
            $token->userId = $user->getId();
            $token->generateToken();
            $token->save();
            return $token->accessToken;
        }
        return $user;

    }

    /**
     * API. Апи для авторизации пользователя
     * АПИ должно принимать входящие параметры:
     * Email
     * Пароль
     * Проверять, есть ли в БД пользователь с таким email и паролем
     * Если есть, то выдавать ключ доступа accessToken, если нет возвращать ошибку
     */

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->auth()) {
            return $token->accessToken;
        } else {
            return $model;
        }
    }
}