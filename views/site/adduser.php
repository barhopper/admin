<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

$this->title = 'Add User';
$form = ActiveForm::begin([
	'method' => 'post',
	'id' => 'add-user',
	'layout' => 'horizontal',
	'options' => ['autocomplete' => 'off'],
	'fieldConfig' => [
		'template' => "{input}",
	],
]);

?>
<div class="site-all" align="center" style="height: 100%;">
	<img src="img/user_line.png"/>
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
				<b>First Name</b>
			</p>
		</div>
		<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
			<?= $form->field($model,'first_name',['inputOptions'=>['style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->input(['autocomplete' => 'new-user']) ?>
		</div>

		<div style="padding: 10px 0 5px 20px;color: #808080;">
			<p style="margin-bottom: 0; text-align:left">
				<b>Last Name</b>
			</p>
		</div>
		<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
			<?= $form->field($model,'last_name',['inputOptions'=>['style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->input(['autocomplete' => 'new-user']) ?>
		</div>

		<div style="padding: 10px 0 5px 20px;color: #808080;">
			<p style="margin-bottom: 0; text-align:left">
				<b>Email</b>
			</p>
		</div>
		<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
			<?= $form->field($model,'email',['inputOptions'=>['style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->input(['autocomplete' => 'new-user']) ?>
		</div>

		<div style="padding: 10px 0 5px 20px;color: #808080;">
			<p style="margin-bottom: 0; text-align:left">
				<b>Password</b>
			</p>
		</div>
		<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
			<?= $form->field($model,'password',['inputOptions'=>['style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->passwordInput(['autocomplete' => 'new-password']) ?>
		</div>

		<div style="padding: 10px 0 5px 20px;color: #808080;">
			<p style="margin-bottom: 0; text-align:left">
				<b>Confirm Password</b>
			</p>
		</div>
		<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
			<?= $form->field($model,'confirm_password',['inputOptions'=>['style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->passwordInput() ?>
		</div>
		<div style="padding: 5px 0;"></div>
		<div style="padding: 10px 0 5px 20px;color: #808080;">
			<p style="margin-bottom: 0; text-align:left">
				<b>Role</b>
			</p>
		</div>
		<div style="width: 797px;height: 40px;padding: 10px 0 5px 20px;color: #808080;">
			<div style="float: left; padding: 10px 20px 0 0px;">
				<input type="radio" class="radio_item" checked onchange="selectChange();" value="3" name="role" id="radio0">
				<label class="label_item" for="radio0"><img id="imgradio0" src="img/select_active.png">&nbsp;Profile</label>
			</div>
			<div style="float: left; padding: 10px 20px 0 0px;">
				<input type="radio" class="radio_item" onchange="selectChange();" value="4" name="role" id="radio1">&nbsp;
				<label class="label_item" for="radio1"><img id="imgradio1" src="img/select.png"/>&nbsp;Air Time</label>
			</div>
			<div style="float: left; padding: 10px 20px 0 0px;">
				<input type="radio" class="radio_item" onchange="selectChange();" value="5" name="role" id="radio2">&nbsp;
				<label class="label_item" for="radio2"><img id="imgradio2" src="img/select.png"/>&nbsp;Settings</label>
			</div>
			<div style="float: left; padding: 10px 20px 0 0px;">
				<input type="radio" class="radio_item" onchange="selectChange();" value="6" name="role" id="radio3">&nbsp;
				<label class="label_item" for="radio3"><img id="imgradio3" src="img/select.png"/>&nbsp;Payment</label>
			</div>
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