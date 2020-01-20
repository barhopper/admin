<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = $this->title;
$errstr = '';
?>
    <?php $form = ActiveForm::begin([
        'action' => ['forgot'],
        'id' => 'forgot-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div style='padding: 4px 30px 0px 60px;'>{input}</div>",
        ],
    ]); 
    ?>
<div style="margin: auto;max-width: 484px;min-width: 283px;">
	<div style="width: 255px;height: 183px;background-image:url('img/site_logo.png');"></div>
	
<div style="padding: 35px 0 0 0;"></div>

<label style="color: #FFFFFF;">Forgot Password</label>
<div style="padding: 10px 0 10px;"></div>
<?php
$form->errorSummaryCssClass = "err";
$errorStr = $form->errorSummary($model, ['header' => '']);
$errorStr = str_replace('<ul>', '<ul style="list-style-type: none;margin-left: 0;padding-left: 0;color:red;">', $errorStr);
echo $errorStr;
?>
	<div style="background-image:url('img/formemail.png');width: 287px;height: 49px;padding: 6px 0 0 30px;">
		<?=  Html::input('text', 'LoginForm[email]',  Yii::$app->request->post('LoginForm[email]'), ['class' => 'email', 'name' => 'LoginForm[email]', 'placeholder' => 'Email', 'style' => 'outline-width: 0;width: 210px;height: 36px; border: 0; background: transparent;']) ?>
	</div>
	
<div style="padding: 10px 0 30px;"></div>
	<?= Html::submitButton('Send', ['class' => 'btn', 'name' => 'send-button', 'style' => 'font-size: 20px;color: #FFFFFF;background: #ff2741;border-radius: 25px;width:287px;height:47px;']) ?>
	

<div style="color:#999;margin:1em 0 0 0">
	<?= Html::a('Login', ['site/login'], ['style' => 'color: #FFFFFF;']) ?>
</div>
</div>    
<?php ActiveForm::end(); ?>
