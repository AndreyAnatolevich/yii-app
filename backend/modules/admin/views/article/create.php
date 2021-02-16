<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BaseArticle */

$this->title = 'Create Articles';
$this->params['breadcrumbs'][] = ['label' => 'Base Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
