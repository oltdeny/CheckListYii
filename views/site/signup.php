<h1>Регистрация</h1>
<?php
use yii\widgets\ActiveForm;
?>

<?php
    $form = ActiveForm::begin(['class' => 'form-horizontal']);
?>

<?= $form->field($model, 'name')->textInput() ?>
<?= $form->field($model, 'email')->textInput() ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<div>
    <button type="submit" class="btn btn-primary">Sign Up!</button>
</div>

<?php
    ActiveForm::end();
?>
