<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OaGoods */

$this->title = '更新产品:' . $model->devNum;
$this->params['breadcrumbs'][] = ['label' => '产品推荐', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->devNum, 'url' => ['view', 'id' => $model->nid]];
$this->params['breadcrumbs'][] = '更新';
?>
<div>
   <?= Html::img($model->img,['width'=>100,'height'=>100])?>
</div>
<div class="oa-goods-update">
    <?= $this->render('_formUpdateReset', [
        'model' => $model,
    ]) ?>


</div>
