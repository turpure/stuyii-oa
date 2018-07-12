<?php

use  yii\helpers\Html;
use \kartik\form\ActiveForm;
use  \kartik\grid\GridView;
use kartik\daterange\DateRangePicker;

$this->title = '销售产品表现';
?>
<?php //echo $this->render('_search'); ?>
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<div class="product-perform-index">

    <!--搜索框开始-->
    <div class="box-body row">
        <?php $form = ActiveForm::begin([
            'action' => ['stock-perform/sales'],
            'method' => 'get',
            'options' => ['class' => 'form-inline drp-container form-group col-lg-12'],
            'fieldConfig' => [
                'template' => '{label}<div class="form-group text-right">{input}{error}</div>',
                //'labelOptions' => ['class' => 'col-lg-3 control-label'],
                'inputOptions' => ['class' => 'form-control'],
            ],
        ]); ?>

        <?= $form->field($model, 'code', ['template' => '{label}{input}', 'options' => ['class' => 'col-lg-2']])
            ->dropDownList([1 => '备货', 2 => '不备货'], ['prompt' => '请选择'])->label('是否是备货产品:') ?>

        <?= $form->field($model, 'cat', ['template' => '{label}{input}', 'options' => ['class' => 'col-lg-2']])
            ->dropDownList($list, ['prompt' => '请选择销售员'])->label('销售员:') ?>

        <?= $form->field($model, 'create_range', [
            'template' => '{label}{input}{error}',
            //'addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-calendar"></i>']],
            'options' => ['class' => 'col-lg-3']
        ])->widget(DateRangePicker::classname(), [
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ])->label("开发时间:"); ?>

        <div class="">
            <?= Html::submitButton('<i class="glyphicon glyphicon-hand-up"></i> 确定', ['class' => 'btn btn-primary']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <!--搜索框结束-->

    <!--列表开始-->
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
//    'filterModel'=>$searchModel,
        'showPageSummary' => true,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary', 'heading' => '销售产品表现'],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'saler',
                //'width' => '150px',
                'hAlign' => 'right',
                'label' => '销售员',
                'pageSummary' => 'Page Summary',
                'pageSummaryOptions' => ['class' => 'text-right text-warning'],
            ],
            [
                'attribute' => 'Number',
                //'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal', 0],
                'label' => '销售产品款数',
                'pageSummary' => true
            ],
            [
                'attribute' => 'orderNum',
                //'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal', 0],
                'label' => '出单产品款数',
                'pageSummary' => true
            ],
            [
                'attribute' => 'orderRate',
                //'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal', 2],
                'label' => '出单率(%)',
                //'pageSummary' => true
            ],
            [
                'attribute' => 'exuStyleNum',
                'label' => '旺款数量',
                'hAlign' => 'right',
                //'width' => '150px',
                'format' => ['decimal', 0],
                'pageSummary' => true,
            ],
            [
                'attribute' => 'exuStyleRate',
                //'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal', 2],
                'label' => '旺款率(%)',
                //'pageSummary' => true
            ],
            [
                'attribute' => 'hotStyleNum',
                'label' => '爆款数量',
                'hAlign' => 'right',
                'format' => ['decimal', 0],
                'pageSummary' => true,
            ],
            [
                'attribute' => 'hotStyleRate',
                //'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal', 2],
                'label' => '爆款率(%)',
                //'pageSummary' => true
            ]
        ],
    ]); ?>
    <!--列表结束-->
</div>




