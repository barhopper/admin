<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

$this->title = 'Settings';
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
<div class="site-all" align="center" style="height: 100%;">
	<img src="img/setting_line.png"/>
	<div style="padding: 10px 0px;"></div>

	<div align="center" style="background-color: #ffffff;border: 1px solid #d7d7d7;width:837px;height: auto;">

		<div align="left" style="float: left;padding: 10px 20px 0px 20px;">
			<p style="margin-bottom: 0;">
				<b>Personal Info</b>
			</p>
		</div>
		<div align="right" style="float: right;padding: 10px 20px 0px 20px;">
			<input id="btninfo" type="button" onclick="showElement('info')" style="border: 0px solid transparent;width:15px;height:9px;background: url(img/open.png)">
		</div>

		<img src="img/red_line.png"/>
		<div style="padding: 5px 0px;"></div>
		<div id="info">
			<?php
			$form = ActiveForm::begin([
				'method' => 'post',
				'id' => 'edit-user',
				'layout' => 'horizontal',
				'options' => ['autocomplete' => 'off'],
				'fieldConfig' => [
					'template' => "{input}",
				],
			]);
			$form->errorSummaryCssClass = "err";
			$errorStr = $form->errorSummary($personal, ['header' => '']);
			$errorStr = str_replace('<ul>', '<ul style="list-style-type: none;margin-left: 0;padding-left: 0;color:red;">', $errorStr);
			echo $errorStr;
			?>
			<div style="padding: 10px 0 5px 20px;color: #808080;">
				<p style="margin-bottom: 0; text-align:left">
					<b>First Name</b>
				</p>
			</div>
			<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
				<?= $form->field($personal,'first_name',['inputOptions'=>['style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->textInput(['value'  => $personal->first_name]) ?>
			</div>

			<div style="padding: 10px 0 5px 20px;color: #808080;">
				<p style="margin-bottom: 0; text-align:left">
					<b>Last Name</b>
				</p>
			</div>
			<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
				<?= $form->field($personal,'last_name',['inputOptions'=>['style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->textInput(['value'  => $personal->last_name]) ?>
			</div>

			<div style="padding: 5px 0;"></div>
			<div align="right" style="padding: 0px 0px 0px 0px;background-color: #ffff;width:797px;height: auto;">
				<?= Html::submitButton('', ['class' => 'btn', 'name' => 'save-button', 'style' => 'border: 0px solid transparent;width:153px;height:38px;background: url(img/save_changes.png)']) ?>
			</div>

			<input type="hidden" name="action" value="edit"/>
			<?php
			ActiveForm::end();
			?>
			<div style="padding: 5px 0px;"></div>
			<img src="img/grey_line2.png"/>
			<div style="padding: 5px 0px;"></div>
			<?php
			$avatar = $personal->filename;
			if ($avatar && file_exists($avatar)) {
				$avatarimg = $avatar;
			}
			else {
				$avatarimg = 'img/avatar.png';
			}
			?>

			<div align="left" style="float: left;padding: 0 0 160px 20px;width:300px;height: 150px; color: #808080;">
				<div class='circular--portrait-big2'><img src="<?=$avatarimg ?>"/></div>
			</div>
			<?php
			$form = ActiveForm::begin(['action' => 'setting', 'options' => ['enctype' => 'multipart/form-data'], 'id' => 'fileupload']);
			?>
			<div align="right" style="float: right;padding: 0px 20px 0px 0px;background-color: #ffff;width:400px;height: 150px;">
				<div style="padding: 50px 0px;"></div>
				<div align="right" style="padding: 15px 0;">
					<?= Html::submitButton('', ['onclick' => 'UploadFile();return false;', 'class' => 'btn', 'name' => 'save-button', 'style' => 'border: 0px solid transparent;width:153px;height:38px;background: url(img/change_image.png)']) ?>
				</div>
				
			</div>
			<input type="hidden" name="action" value="upload"/>
			<input type="file" id="avatar" name="avatar" accept='image/*' style="visibility: hidden;height:0;">
			
			<?php
			ActiveForm::end();
			?>
			
			<img src="img/grey_line2.png"/>
			<div style="padding: 5px 0px;"></div>
			
		</div>
		<div align="left" style="float: left;padding: 10px 20px 0px 20px;">
			<p style="margin-bottom: 0;">
				<b>Change Password</b>
			</p>
		</div>
		<div align="right" style="float: right;padding: 10px 20px 0px 20px;">
			<input id="btnchange" type="button" onclick="showElement('change')" style="border: 0px solid transparent;width:15px;height:9px;background: url(img/open.png)">
		</div>

		<img src="img/red_line.png"/>
		<div style="padding: 5px 0px;"></div>
		<div id="change">
			<?php
			$form = ActiveForm::begin([
				'method' => 'post',
				'id' => 'change-password',
				'layout' => 'horizontal',
				'options' => ['autocomplete' => 'off'],
				'fieldConfig' => [
					'template' => "{input}",
				],
			]);
			$form->errorSummaryCssClass = "err";
			$errorStr = $form->errorSummary($model, ['header' => '']);
			$errorStr = str_replace('<ul>', '<ul style="list-style-type: none;margin-left: 0;padding-left: 0;color:red;">', $errorStr);
			echo $errorStr;
			?>
			<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
				<?= $form->field($model,'password',['inputOptions'=>['placeholder'=>'Current Password', 'style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->passwordInput(['autocomplete' => 'new-password']) ?>
			</div>
			<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
				<?= $form->field($model,'new_password',['inputOptions'=>['placeholder'=>'New Password', 'style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->passwordInput() ?>
			</div>
			<div style="width: auto;height: 50px; padding: 5px 0 5px 0;color: #808080;">
				<?= $form->field($model,'confirm_password',['inputOptions'=>['placeholder'=>'Confirm Password', 'style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;border-radius: 8px;width: 797px;height: 40px;']])->passwordInput() ?>
			</div>
			<div style="padding: 5px 0;"></div>
			<div align="right" style="padding: 0px 0px 0px 0px;background-color: #ffff;width:797px;height: auto;">
				<?= Html::submitButton('', ['class' => 'btn', 'name' => 'save-button', 'style' => 'border: 0px solid transparent;width:153px;height:38px;background: url(img/save_changes.png)']) ?>
			</div>

			<div style="padding: 10px 0px;"></div>
			<input type="hidden" name="action" value="change"/>

			<?php
			ActiveForm::end();
			?>
		</div>


		<div align="left" style="float: left;padding: 10px 20px 0px 20px;">
			<p style="margin-bottom: 0;">
				<b>Manage Users</b>
			</p>
		</div>
		<div align="right" style="float: right;padding: 10px 20px 0px 20px;">
			<input id="btnusers" type="button" onclick="showElement('users')" style="border: 0px solid transparent;width:15px;height:9px;background: url(img/open.png)">
		</div>

		<img src="img/red_line.png"/>
		<div style="padding: 5px 0px;"></div>

		<div align="center" id="users" style="background-color: #ffffff;border: 0px solid #d7d7d7;width:785px;height: auto;">
			<div align="left" style="float: left;padding: 10px 20px 0px 10px;">
				<p style="margin-bottom: 0;">
					<b>Current Users</b>
				</p>
			</div>
			<img src="img/grey_line2.png"/>
			<?php


			for ($i = 0; $i < count($users); $i++) {
				$avatar = $users[$i]->filename;
				if ($avatar && file_exists('images/'.$avatar)) {
					$avatarimg = 'images/'.$avatar;
				}
				else {
					$avatarimg = 'img/avatar.png';
				}
			?>
			<div style="padding: 5px 0px;"></div>
			<div align="left" style="width:785px;height: 55px;">
				<div align="left" style="float: left;">
				<div class='circular--portrait'>
				<img src='<?=$avatarimg ?>'>
				</div>
				</div>
				<div align="left" style="float: left;padding: 0 10px;height: 100%"></div>
				<div align="left"><?=$users[$i]->first_name ?> <?=$users[$i]->last_name ?></div>
				<div class="radio-toolbar">
					<div style="float: left; padding: 10px 30px 0 0px;">
						<input type="radio" class="radio_item" <?php
						if ($users[$i]->role_id == 3)
							echo 'checked'; ?> onchange="selectChange(<?=$users[$i]->id ?>);" value="3" name="item<?=$users[$i]->id ?>" id="radio_<?=$users[$i]->id ?>_0">
						<label class="label_item" for="radio_<?=$users[$i]->id ?>_0"><img id="imgradio_<?=$users[$i]->id ?>_0" src="img/select.png">&nbsp;
							<i>Profile</i></label>
					</div>
					<div style="float: left; padding: 10px 30px 0 0px;">
						<input type="radio" class="radio_item" <?php
						if ($users[$i]->role_id == 4)
							echo 'checked'; ?> onchange="selectChange(<?=$users[$i]->id ?>);" value="4" name="item<?=$users[$i]->id ?>" id="radio_<?=$users[$i]->id ?>_1">&nbsp;
						<label class="label_item" for="radio_<?=$users[$i]->id ?>_1"><img id="imgradio_<?=$users[$i]->id ?>_1" src="img/select.png"/>&nbsp;
							<i>Air Time</i></label>
					</div>
					<div style="float: left; padding: 10px 30px 0 0px;">
						<input type="radio" class="radio_item" <?php
						if ($users[$i]->role_id == 5)
							echo 'checked'; ?> onchange="selectChange(<?=$users[$i]->id ?>);" value="5" name="item<?=$users[$i]->id ?>" id="radio_<?=$users[$i]->id ?>_2">&nbsp;
						<label class="label_item" for="radio_<?=$users[$i]->id ?>_2"><img id="imgradio_<?=$users[$i]->id ?>_2" src="img/select.png"/>&nbsp;
							<i>Settings</i></label>
					</div>
					<div style="float: left; padding: 10px 30px 0 0px;">
						<input type="radio" class="radio_item" <?php
						if ($users[$i]->role_id == 6)
							echo 'checked'; ?> onchange="selectChange(<?=$users[$i]->id ?>);" value="6" name="item<?=$users[$i]->id ?>" id="radio_<?=$users[$i]->id ?>_3">&nbsp;
						<label class="label_item" for="radio_<?=$users[$i]->id ?>_3"><img id="imgradio_<?=$users[$i]->id ?>_3" src="img/select.png"/>&nbsp;
							<i>Payment</i></label>
					</div>
					<div style="float: right; padding: 10px 0px 0 0px;">
						<a href="deleteuser?id=<?=$users[$i]->id ?>" onclick="if(!confirm('Delete user?')) return false;">
							<font color="red">
								<b>DELETE</b></font></a>
					</div>
				</div>
			</div>
			<img src="img/grey_line2.png"/>
			<?php
		}
			?>



			<div align="right" style="padding: 10px 0px 0px 0px;background-color: #ffff;width:785px;height: auto;">
				<?= Html::Button('', ['onclick' => 'document.location.href="adduser"', 'class' => 'btn', 'name' => 'add-button', 'style' => 'border: 0px solid transparent;width:153px;height:38px;background: url(img/adduser.png)']) ?>
			</div>

			<div align="left" style="float: left;padding: 10px 20px 0px 10px;">
				<p style="margin-bottom: 0;">
					<b>Invite Users</b>
				</p>
			</div>
			<img src="img/grey_line2.png"/>
		</div>

		<div style="padding: 50px 0px;"></div>
	</div>
</div>
<script>

	function showElement(ele)
	{
		var src = document.getElementById('btn' + ele).style.backgroundImage;

		if (src == 'url("img/open.png")')
			document.getElementById('btn' + ele).style.backgroundImage = 'url("img/close2.png")';
		else
			document.getElementById('btn' + ele).style.backgroundImage = 'url("img/open.png")';

		$('#'+ele).slideToggle("slow");
	}
	function selectChange(itemid)
	{
		var ele;
		if (itemid == -1)
			ele = document.getElementsByTagName('input');
		else
			ele = document.getElementsByName('item'+itemid);
		for (i = 0; i < ele.length; i++) {
			if (ele[i].name.indexOf("item") == -1)
				continue;
			var res = ele[i].id.split("_");
			id = res[1];
			pos = res[2]
			if (ele[i].checked) {
				document.getElementById("imgradio_" + id + "_" + pos).src = "img/select_active.png";
				if (itemid != -1)
					document.location = "changerole?id=" + id + "&role=" + (Number(pos)+3);
			}
			else {
				document.getElementById("imgradio_" + id + "_" + pos).src = "img/select.png";
			}
		}
	}
	function UploadFile()
	{
		$("#avatar").click();
	}
	
	$('#avatar').on("change", function() { $("#fileupload").submit() });
	selectChange(-1);
</script>


