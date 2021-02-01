<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BaseArticle */

$this->title = 'Update Base Article: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Base Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->articleId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="base-article-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
