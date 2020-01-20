<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

$this->title = 'Edit Information';
$form = ActiveForm::begin([
	'method' => 'post',
	'id' => 'edit-information',
	'layout' => 'horizontal',
	'fieldConfig' => [
		'template' => "{input}",
	],
]);

?>
<div class="site-all" align="center" style="height: 100%;">
	<img src="img/edit_line.png"/>
	<div style="padding: 10px 0px;"></div>

	<div align="center" style="background-color: #ffffff;border: 1px solid #d7d7d7;width:837px;height: auto;">
		<div style="padding: 20px 0px;"></div>
		<?php

		$form->errorSummaryCssClass = "err";
		$errorStr = $form->errorSummary($model, ['header' => '']);
		$errorStr = str_replace('<ul>', '<ul style="list-style-type: none;margin-left: 0;padding-left: 0;color:red;">', $errorStr);
		echo $errorStr;
		?>

		<div style="padding: 10px 0 5px 20px;color: #808080;">
			<p style="margin-bottom: 0; text-align:left">
				<b>Name</b>
			</p>
		</div>
		<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
			<?= $form->field($model,'name',['inputOptions'=>['style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->label(false) ?>
		</div>

		<div style="padding: 10px 0 5px 20px;color: #808080;">
			<p style="margin-bottom: 0; text-align:left">
				<b>Info</b>
			</p>
		</div>
		<div style="width: 797px;height: auto; padding: 5px 0 5px 0;color: #808080;">
			<?= $form->field($model,'text',['inputOptions'=>['style' => ' resize: none;outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: auto;']])->textarea() ?>
		</div>
		

		<div style="padding: 10px 0 5px 20px;color: #808080;">
			<p style="margin-bottom: 0; text-align:left">
				<b>Phone</b>
			</p>
		</div>
		<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
			<?= $form->field($model,'phone',['inputOptions'=>['style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->label(false) ?>
		</div>

		<div style="padding: 10px 0 5px 20px;color: #808080;">
			<p style="margin-bottom: 0; text-align:left">
				<b>Location</b>
			</p>
		</div>
		<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
		<?= $form->field($model,'location',['inputOptions'=>['style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->label(false) ?>
		</div>
		
		<div style="padding: 10px 0 5px 20px;color: #808080;">
			<p style="margin-bottom: 0; text-align:left">
				<b>Email</b>
			</p>
		</div>
		<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
			<?= $form->field($model,'email',['inputOptions'=>['style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->label(false) ?>
		</div>
		
		<div style="padding: 10px 0 5px 20px;color: #808080;">
			<p style="margin-bottom: 0; text-align:left">
				<b>Address</b>
			</p>
		</div>
		<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
			<?= $form->field($model,'address',['inputOptions'=>['style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->label(false) ?>
		</div>
		
		<div style="padding: 5px 0;"></div>
		<div align="right" style="padding: 0px 0px 0px 0px;background-color: #ffff;width:797px;height: auto;">
			<?= Html::submitButton('', ['class' => 'btn', 'name' => 'save-button', 'style' => 'border: 0px solid transparent;width:153px;height:38px;background: url(img/save_changes.png)']) ?>
		</div>
		<div style="padding: 20px 0px;"></div>
	</div>
</div>
<script>
	function selectChange()
	{
		var ele = document.getElementsByName('role');
		for (i = 0; i < ele.length; i++) {
			if (ele[i].checked) {
				document.getElementById("imgradio"+i).src = "img/select_active.png";
			}
			else {
				document.getElementById("imgradio"+i).src = "img/select.png";
			}
		}
	}
</script>
<?php
ActiveForm::end();