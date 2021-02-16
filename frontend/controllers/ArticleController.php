<?php
namespace frontend\controllers;

use yii\rest\ActiveController;

class ArticleController extends ActiveController
{
public $modelClass = 'frontend\models\ArticleSearch';
}