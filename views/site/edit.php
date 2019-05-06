<h1>Edit task</h1>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description')->textInput() ?>
        </div>
        <div class="col-md-12">
            <?= Html::submitButton('Edit', ['name' => 'Edit',
                'value' => 'Create', 'class'=>'btn brn-success']) ?>
        </div>
    </div>
<?php $form = ActiveForm::end(); ?>