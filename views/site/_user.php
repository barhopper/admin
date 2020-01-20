<?php
use yii\helpers\Html;

$image = $model->image;
echo "<div style=\"background-color: white;width:486px;height:auto; padding: 10px 0 0 0;\" align='center'>";
//if($model->image && file_exists('images/'.$model->image['path']))
//	echo "<img height='208' src='images/".$model->image['path']."' />";
echo "<div style='width: 80%; height:75px;padding: 10px 0 0 0;'>\n";
echo "<div style='float: left;width: 100%;'><div style='text-align:right;width:100%;'><font color='grey'>" . $model->date . "</font></div>\n";
echo "<div style='text-align:left;'>" . $model->text . "</div>\n";
echo "</div>";