<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;


$this->title = 'Profile';

$form = ActiveForm::begin([
	'method' => 'post',
	'action' => ['profile'],
]);

?>
<div class="site-all" align="center">
	<div align="center" style="padding: 20px 20px 20px 20px; background-color: #ffffff;border: 1px solid #d7d7d7;width:842px;height: auto;">
		<div align="left" style="padding: 20px 20px 20px 20px;position: relative;width:802px;height: 539px; background: url('img/bar.png')">
			<div style="position: absolute; bottom: 20px;float: left;">
				<font style="font-size:30px; color:#F8F8F8;">O'Keefe's Bar & Grill</font>
				<br/>
				<img src="img/star.png"/>&nbsp;<img src="img/star.png"/>&nbsp;<img src="img/star.png"/>&nbsp;
				<b>
					<font color="white">(3)</font>
				</b>
			</div>
		</div>
		<div style="padding: 10px 0px;"></div>

		<div align="center" style="padding: 5px 20px 5px 20px;float: left;height: 29px;">
			<a href="venue">
				Information</a>
		</div>
		<div align="center" style="padding: 5px 20px 5px 20px;float: left;height: 29px;">
			<a href="service">Services (4)</a>
		</div>
		<div align="center" style="padding: 5px 20px 5px 20px;float: left;height: 29px;">
			<a href="review">Reviews (123)</a>
		</div>
		<div align="center" style="padding: 5px 20px 5px 20px;float: left;background-color: #c42d3e;height: 29px;">
			<a href="feed">
				<font color="white">Live Feed</font></a>
		</div>
		<div align="center" style="padding: 5px 20px 5px 20px;float: left;height: 29px;">
			<a href="gallery">Gallery</a>
		</div>

		<img width="802" src="img/red_line.png" style="vertical-align:top;"/>

		<div align="left" style="padding: 0px 5px 5px 5px;">
			<p>
				Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Far far away, behind thea word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.
			</p>
		</div>
		<div align="left" style="padding: 0px 0px 10px 20px;">
			<img src="img/phone.png"/>&nbsp;&nbsp;(213) 222-331234
		</div>
		<div align="left" style="padding: 0px 0px 10px 20px;">
			<img src="img/place.png"/>&nbsp;&nbsp;Mission Hills, Los Angeles
		</div>
		<div align="left" style="padding: 0px 0px 10px 20px;">
			<img src="img/mail.png"/>&nbsp;&nbsp;sample@email.com
		</div>
		<div align="left" style="padding: 0px 0px 10px 20px;">
			<img src="img/url.png"/>&nbsp;&nbsp;www.sample.com
		</div>

		<img width="802" src="img/red_line.png" style="vertical-align:top;"/>
		<div style="padding: 10px 0px;"></div>
		<div align="right" style="padding: 0px 0px 0px 0px;background-color: #ffff;width:797px;height: auto;">
			<?php
			echo Html::submitButton('', ['class' => 'btn', 'name' => 'editinfo', 'value' => $model->id, 'style' => 'border: 0px solid transparent;width:177px;height:37px;background: url(img/editinf.png)']);
			?>
		</div>

		<div style="padding: 20px 0px;"></div>
	</div>

</div>
<?php
ActiveForm::end();
?>
