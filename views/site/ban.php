<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

$this->title = 'Banned Users';

$form = ActiveForm::begin([
    'method' => 'get',
    'action' => ['banned'],
]);

?>
<script>
function changeSearch(){
	if(document.getElementById('username').value == "")
		document.getElementById('close').style.visibility="hidden";
	else
		document.getElementById('close').style.visibility="visible"
}
function clearSearch(){
	document.getElementById('username').value = "";
	document.getElementById('w0').submit();
}
</script>
<div class="site-banned" align="center">
    <img src="img/line_ban.png"/>
    <div style="padding: 20px 0px;">
    <div style="background-image: url('img/search_box.png');width:484px;height:37px; padding: 1px 5px 1px 15px;position:relative;" align="left">
<?php
   		echo Html::input('text', 'username',  Yii::$app->request->get('username'), ['id' => 'username', 'class' => 'username', 'name' => 'username', 'placeholder' => "Search", 'style' => 'outline-width: 0;-webkit-box-shadow: 0 0 0px 1000px white inset;width: 407px;height: 34px; border: 0; background: transparent;']);
		echo '<button type="submit" style="position:absolute; top:8px;  border: 0px;width:30px;height:20px;background-color: white;"><img src="img/search.png"/></button>';
		echo '<button type="submit" id="close" onclick="clearSearch()" style="position:absolute; top:8px;right:2px; border: 0px;width:30px;height:20px;background-color: white;"><img src="img/close.png"/></button>';
?>    	
    </div>
</div>

<?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_ban',
    'layout' => "<div style='background-image: url(img/grey_line.png);width:484px;height:1px;'></div>{items}<div style='background-image: url(img/grey_line.png);width:484px;height:1px;'></div>{pager}",
    'summary' => "Showing {begin}-{end} of {totalCount} Users.",
    'emptyText' => 'Users not found',
]);


?>
</div>
<?php
	ActiveForm::end();
?>
<script>
changeSearch();
</script>