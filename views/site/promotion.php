<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

$this->title = 'Promotions Feed';

$form = ActiveForm::begin([
	'method' => 'get',
	'action' => ['report'],
]);

?>
<div class="site-all" align="center" style="height: 100%;">
<img src="img/promotion_line.png"/>
<div style="padding: 10px 0px;"></div>

<div align="center" style="background-color: #ffffff;border: 1px solid #d7d7d7;width:837px;height: auto;">
	<div align="left" style="padding: 10px 20px 10px 20px;">
		<p>Post your events and specials on Barhoppers Promotions Feeds. Users will be able to browse through the promotions feed to find what they are looking for.</p>
	</div>
	<div align="left" style="padding: 10px 20px 0px 20px;">
		<p style="margin-bottom: 0;">
			<b>Promotional Details</b>
		</p>
	</div>
	<img src="img/red_line.png"/>
	<div style="padding: 5px 0px;"></div>
	<div align="left" style="padding: 5px 5px;background-color: #ffffff;border: 1px solid #d7d7d7; border-radius: 5px; width:797px;height: auto;">
		<p>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.
		</p>
	</div>
	<div style="padding: 5px 0px;"></div>
	<div align="left" style="padding: 0px 0px 0px 0px;background-color: #ffff;width:797px;height: 57px;">
		<div align="center" style="float: left;border: 1px solid #d7d7d7; border-radius: 10px;width:60px;height: 57px;">
			<img src="images/2.jpg"  class="avatarbar">
		</div>

		<div align="center" style="float: left; margin: 0px 10px 0px 10px; border: 1px solid #d7d7d7; border-radius: 10px;width:60px;height: 57px;">
			<img src="img/plus.png" class="avatarbar">
		</div>
	</div>
	<div style="padding: 5px 0px;"></div>
	<div align="right" style="padding: 0px 0px 0px 0px;background-color: #ffff;width:797px;height: auto;">
		<?php
		echo Html::submitButton('', ['class' => 'btn', 'name' => 'post', 'value' => $model->id, 'style' => 'border: 0px solid transparent;width:153px;height:38px;background: url(img/post.png)']);
		?>
	</div>
	<div align="left" style="padding: 10px 0px 0px 0px;background-color: #ffff;width:797px;height: auto;">
		<div align="left" style="float: left;">
			<b>Purchase Promotions Feed Posts</b>
		</div>
		<div align="left" style="float: right;">
			<b>
				<i>
					<font color="red">You have 13/20 posts available.</font></i></b>
		</div>
	</div>
	<img src="img/red_line.png"/>
	<div align="left" style="padding: 10px 0px 0px 0px;background-color: #ffff;width:797px;height: auto;">
		<div align="left" style="float: left;">
			<div class="radio-toolbar">
				<input type="radio" class="radio_item" onchange="selectChange();" value="" name="item" id="radio0">
				<label class="label_item" for="radio0"><img id="imgradio0" src="img/select.png">10 Posts - Free</label>

				<input type="radio" class="radio_item" onchange="selectChange();" value="" name="item" id="radio1">
				<label class="label_item" for="radio1"><img id="imgradio1" src="img/select_active.png"/>10 Posts - $1.00</label>
			</div>
		</div>

	</div>
		<div style="padding: 10px 0px;"></div>
		<div align="right" style="padding: 0px 0px 0px 0px;background-color: #ffff;width:797px;height: auto;">
			<?php
			echo Html::submitButton('', ['class' => 'btn', 'name' => 'purchase', 'value' => $model->id, 'style' => 'border: 0px solid transparent;width:153px;height:38px;background: url(img/purchase.png)']);
		?>
		</div>
		
	<div style="padding: 50px 0px;"></div>	
	<script>
		function selectChange()
		{
			var ele = document.getElementsByName('item');
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


	?>
</div>
<?php
ActiveForm::end();
?>
