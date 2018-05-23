<?php
use yii\grid\GridView;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\BaseHtml;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="form-group">

	<?php echo Html::beginForm('bad_domains', 'POST'); ?>

	<?= BaseHtml::input('input', 'domain') ?>

	<div class="form-group">
		<?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
	</div>

	<?php BaseHtml::endForm() ?>

</div>

<?= GridView::widget([
	'dataProvider' => $domains,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
		'name',
    ],
]); ?>

