<h1>ToDo List</h1>
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
        <?= Html::submitButton('Create task', ['name' => 'Create',
            'value' => 'Create', 'class'=>'btn brn-success']) ?>
    </div>
</div>
<?php $form = ActiveForm::end(); ?>

<script>
    function To_completed(id)
    {
        window.location.replace("completed/"+id);
    }
</script>

<table class="table" style="margin-top: 2%">
    <thead>
    <tr>
        <td>Completed</td>
        <td>Title</td>
        <td>Description</td>
        <td>Actions</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($model2 as $item):?>
        <tr style= "background-color: <?php if ($item->is_completed): ?> #cfe8b7" <?php else: ?> #ffe8a1" <?php endif ?>>
            <td>
                <?= Html::checkbox('', $item->is_completed, ['onclick'=>"To_completed($item->id)"]) ?>
            </td>
            <?php if ($item->is_completed): ?>
                <td><del><?=$item->title?></del></td>
                <td><del><?=$item->description?></del></td>
            <?php else: ?>
                <td><?=$item->title?></td>
                <td><?=$item->description?></td>
            <?php endif ?>
            <td>
                <a href="edit/<?=$item->id?>">Edit</a>
                \
                <a href="delete/<?=$item->id?>">Delete</a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>