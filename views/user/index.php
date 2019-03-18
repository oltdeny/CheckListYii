<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'email:email',
            'count',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    $status = $model->status === 'active';
                    return \yii\helpers\Html::tag(
                        'span',
                        $status ? 'active' : 'blocked',
                        [
                            'class' => 'label label-' . ($status ? 'success' : 'danger'),
                        ]
                    );
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {view}'
            ]
        ],
    ]); ?>
</div>
