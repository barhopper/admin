<?php
use yii\helpers\Html;
$avatar = $model->image;
$ban = $model->ban;
if($avatar && file_exists($avatar->filename)){
	$avatarimg = $avatar->filename;
}else{
	$avatarimg = 'img/avatar.png';
}



echo "<div style=\"background-image: url('img/user_block.png');width:486px;height:76px;\" align='left'>";
echo "<div style='width: 100px; height:76px; float: left; padding: 15px 0 0 0;' align='center'><div class='circular--portrait'><img src='".$avatarimg."'/></div></div>";
echo "<div style='width: 350px;height:76px; float: left;'>";
if($index > 0)
	echo "<div style='background-image: url(img/grey_line.png);width: 350px; height:1px;'></div>";
echo "<div style='width: 200px; height:75px;padding: 30px 0 0 0px;float: left;'><a href = 'user?id=" . $model->id . "'><b>" . $model->first_name." ".$model->last_name. "</b></a></div>";
if($ban){
	echo "<div style='width: 150px; height:75px;padding: 25px 0 0 30px; float: left;'>";
	echo Html::submitButton('', ['class' => 'btn', 'name' => 'removeban', 'value' => $model->id, 'style' => 'border: 0px solid transparent;width:92px;height:32px;background: url(img/lift_ban.png)']);
	echo "</div>";
}
echo "</div></div>";