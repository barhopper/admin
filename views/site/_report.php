<?php
use yii\helpers\Html;
//$avatar = $model->image;
$user = $model->user;
$avatar = $user->image;
if($avatar && file_exists($avatar->filename)){
	$avatarimg = $avatar->filename;
}else{
	$avatarimg = 'img/avatar.png';
}



echo "<div style=\"background-image: url('img/user_block.png');width:486px;height:76px;\" align='left'>\n";
echo "<div style='width: 100px; height:76px; float: left; padding: 15px 0 0 0;' align='center'><div class='circular--portrait'><img src='".$avatarimg."'/></div></div>\n";
echo "<div style='width: 350px;height:76px; float: left;'>\n";
if($index > 0)
	echo "<div style='background-image: url(img/grey_line.png);width: 370px; height:1px;'></div>\n";
echo "<div style='width: 100%; height:75px;padding: 10px 0 0 0;'>\n";
echo "<div style='float: left;width: 100%;'><div style='text-align:right;width:100%;'><font color='grey'>" . $model->date . "</font></div>\n";
echo "<div><b><a href = 'details?user_id=" . $user->id . "&id=".$model->id."'>" . $user->username ."</a></b> " . $model->text . "</div>\n";
echo "</div>\n</div>\n</div>\n";