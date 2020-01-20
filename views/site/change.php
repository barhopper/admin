<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change Password';
$form = ActiveForm::begin([
	'method' => 'post',
	'id' => 'change-password',
	'layout' => 'horizontal',
	'options' => ['autocomplete' => 'off'],
	'fieldConfig' => [
		'template' => "{input}",
	],
]);
?>
<div class="site-change" align="center">

	<?php
	$form->errorSummaryCssClass = "err";
	$errorStr = $form->errorSummary($model, ['header' => '']);
	$errorStr = str_replace('<ul>', '<ul style="list-style-type: none;margin-left: 0;padding-left: 0;color:red;">', $errorStr);
	echo $errorStr;
	?>
	<div style="padding: 50px 0 0 0;"></div>
	<div style="width: 292px;height: 90px; padding: 10px 0 0 0;color: #808080;">
		<?= $form->field($model,'password',['inputOptions'=>['placeholder'=>'Current Password', 'style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 292px;height: 46px;']])->passwordInput(['autocomplete' => 'new-password']) ?>
	</div>
	<div style="width: 292px;height: 90px; padding: 10px 0 0 0;color: #808080;">
		<?= $form->field($model,'new_password',['inputOptions'=>['placeholder'=>'New Password', 'style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 292px;height: 46px;']])->passwordInput() ?>
	</div>
	<div style="width: 292px;height: 90px; padding: 10px 0 0 0;color: #808080;">
		<?= $form->field($model,'confirm_password',['inputOptions'=>['placeholder'=>'Confirm Password', 'style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 292px;height: 46px;']])->passwordInput() ?>
	</div>
	<div style="padding: 10px 0 10px;"></div>
	<?= Html::submitButton('Save', ['class' => 'btn', 'name' => 'save-button', 'style' => 'width:292px;height:47px;font-size: 20px;color: white;background-color: #c42d3e; border-radius: 10px;']) ?>

</div>
<?php
ActiveForm::end();
?>