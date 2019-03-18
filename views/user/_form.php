<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin();?>
    <?php
        if(Yii::$app->user->can('edit')){
            echo $form->field($model, 'count')->textInput();
        }
        else {
            echo $form->field($model, 'count')->textInput(['disabled' => true]);
        }
    ?>
    <?php
        if(Yii::$app->user->can('block')){
            echo $form->field($model, 'status')->textInput(['maxlength' => true]);
        }
        else {
            echo $form->field($model, 'status')->textInput(['maxlength' => true, 'disabled' => true]);
        }
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
