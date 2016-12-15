<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
	$safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2><?= "<?php echo " ?> $this->title <?= " ?> " ?> </h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">

			<?= "<?php " ?>$form = ActiveForm::begin(); ?>

			<?php foreach ($generator->getColumnNames() as $attribute) {
				if (in_array($attribute, $safeAttributes)) {
					echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
				}
			} ?>

			<?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('Create') ?> : <?= $generator->generateString('Update') ?>, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>


			<?= "<?php " ?>ActiveForm::end(); ?>
		</div>
	</div>
</div>

