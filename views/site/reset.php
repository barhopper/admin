<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change Password';
$form = ActiveForm::begin([
    	'method' => 'post',
        'id' => 'change-password',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{input}",
        ],
    ]); 
?>
<div style="margin: auto;max-width: 484px;min-width: 292px;">
<div style="width: 146px;height: 230px;background-image:url('img/site_logo.png');"></div>
<div style="padding: 35px 0 0 0;"></div>

<?php
$form->errorSummaryCssClass = "err";
$errorStr = $form->errorSummary($model, ['header' => '']);
$errorStr = str_replace('<ul>', '<ul style="list-style-type: none;margin-left: 0;padding-left: 0;color:red;">', $errorStr);
echo $errorStr;
?>
<div style="width: 281px;color: white;">
		<p style="float: left;">New Password</p>
        <?= $form->field($model, 'new_password')->passwordInput()->input('password', ['class' => 'form-control', 'style' => 'width: 281px;height: 40px;'])->label(false) ?>

		<p style="float: left;">Confirm Password</p>
        <?= $form->field($model, 'confirm_password')->passwordInput()->input('password', ['class' => 'form-control', 'style' => 'width: 281px;height: 40px;'])->label(false) ?>
	<div style="padding: 30px 0 0 0;"></div>
    <?= Html::submitButton('Reset', ['class' => 'btn', 'name' => 'login-button', 'style' => 'font-size: 20px;color: #40be11;background: #FFFFFF;border-radius: 5px;width:281px;height:45px;']) ?>
</div>
<?php

ActiveForm::end(); 
?>
