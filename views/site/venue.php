<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;


$this->title = 'Venue';

$name = '';//O'Keefe's Bar & Grill
$stars = '';
$info = '<b>No information found</b>';
/*
<img src="img/star.png"/>&nbsp;<img src="img/star.png"/>&nbsp;<img src="img/star.png"/>&nbsp;<img src="img/star.png"/>&nbsp;<img src="img/star.png"/>&nbsp;<b><font color="white">(5)</font></b>*/
$id = -1;

if ($model) {
	$info = $model->text;
	$name = $model->name;
	$stars = '<img src="img/star.png"/>&nbsp;<img src="img/star.png"/>&nbsp;<img src="img/star.png"/>&nbsp;<img src="img/star.png"/>&nbsp;<img src="img/star.png"/>&nbsp;<b><font color="white">(5)</font></b>';
}

?>
<div class="site-all" align="center">
	<div align="center" style="padding: 20px 20px 20px 20px; background-color: #ffffff;border: 1px solid #d7d7d7;width:842px;height: auto;">
		<div align="left" style="padding: 20px 20px 20px 20px;position: relative;width:802px;height: 539px; background: url('img/bar.png')">
			<div style="position: absolute; bottom: 20px;float: left;">
				<font style="font-size:30px; color:#F8F8F8;"><?=$name ?></font>
				<br/>
				<?=$stars ?>
			</div>
		</div>
		<div style="padding: 10px 0px;"></div>

		<div align="center" style="padding: 5px 20px 5px 20px;float: left;vertical-align: bottom;background-color: #c42d3e;height: 29px;">
			<a href="venue"><font color="white">Information</font></a>
		</div>
		<div align="center" style="padding: 5px 20px 5px 20px;float: left;height: 29px;">
			<a href="service">Services (4)</a>
		</div>
		<div align="center" style="padding: 5px 20px 5px 20px;float: left;height: 29px;">
			<a href="review">Reviews (123)</a>
		</div>
		<div align="center" style="padding: 5px 20px 5px 20px;float: left;height: 29px;">
			<a href="feed">Live Feed</a>
		</div>
		<div align="center" style="padding: 5px 20px 5px 20px;float: left;height: 29px;">
			<a href="gallery">Gallery</a>
		</div>

		<img width="802" src="img/red_line.png" style="vertical-align:top;"/>
		
		<div align="left" style="padding: 0px 5px 5px 5px;">
		<p>
				<?=$info ?>
		</p>
		</div>		
		<?php
		if ($model){
		?>
		<div align="left" style="padding: 0px 0px 10px 20px;">
			<img src="img/phone.png"/>&nbsp;&nbsp;<?=$model->phone?>
		</div>
		<div align="left" style="padding: 0px 0px 10px 20px;">
			<img src="img/place.png"/>&nbsp;&nbsp;<?=$model->location?>
		</div>
		<div align="left" style="padding: 0px 0px 10px 20px;">
			<img src="img/mail.png"/>&nbsp;&nbsp;<?=$model->email?>
		</div>
		<div align="left" style="padding: 0px 0px 10px 20px;">
			<img src="img/url.png"/>&nbsp;&nbsp;<?=$model->address?>
		</div>
		<?php
		}
		?>
		<img width="802" src="img/red_line.png" style="vertical-align:top;"/>
		<div style="padding: 10px 0px;"></div>
		<div align="right" style="padding: 0px 0px 0px 0px;background-color: #ffff;width:797px;height: auto;">
		<?php
			echo Html::Button('', ['onclick' => 'document.location.href="editinformation"', 'class' => 'btn', 'name' => 'editinfo', 'value' => $id, 'style' => 'border: 0px solid transparent;width:177px;height:37px;background: url(img/editinf.png)']);
		?>
		</div>
		
		<div style="padding: 20px 0px;"></div>
	</div>

</div>

