<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

$this->title = 'User Details';

?>
<div class="site-all" align="center">

<div style="width:488px;height: auto; background-color: white;border: 1px solid #d7d7d7;padding: 25px 0 25px 0;">
<div style="background-color: white;width:486px; height:auto;" align='center'>
<?php
$avatar = $userModel->image;//->path;

if($avatar && file_exists($avatar->filename)){
	$avatar = "<div class='circular--portrait-big'><img src='".$avatar->filename."'/></div>";
}else{
	$avatar = "<div class='circular--portrait-big'><img src='img/avatar.png'/></div>";	
}

echo $avatar;
echo '<div style="padding: 5px 0 10px;"></div>';
echo "<b>" . $userModel->first_name . " " .$userModel->last_name. "</b>";

?>
</div>

<?php

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_user',
    'layout' => '<div style="padding: 10px 0 0 0;"></div>{items}{pager}',
    'summary' => "Showing {begin}-{end} of {totalCount} Reports.",
    'emptyText' => '<div style="padding: 10px 0 0 0;"></div>Reports not found',
]);
$ban = $userModel->ban;
if(!$ban){
	$form = ActiveForm::begin([
	    'method' => 'get',
	///    'action' => ['/index.php?r=site/ban&id=' . $userModel->id],
	    'action' => ['ban'],
	]);
	$banstr = '<div style="padding: 10px 0 10px;"></div>';
	$banstr .= "<input type='hidden' name='id' value='".$userModel->id."'/>";
	$banstr .= Html::submitButton('Ban This User', ['class' => 'btn', 'name' => 'ban-button', 'style' => 'width:292px;height:47px;font-size: 20px;color: white;background-color: #c42d3e; border-radius: 10px;']);

}else{
	$form = ActiveForm::begin([
	    'method' => 'get',
	///    'action' => ['/index.php?r=site/ban&id=' . $userModel->id],
	    'action' => ['banned'],
	]);

	$banstr = '<div style="padding: 10px 0 10px;"></div>';
	$banstr .= "<input type='hidden' name='removeban' value='".$userModel->id."'/>";
		$banstr .= Html::submitButton('Remove Ban', ['class' => 'btn', 'name' => 'ban-button', 'style' => 'width:292px;height:47px;font-size: 20px;color: white;background-color: #c42d3e; border-radius: 10px;']);
}
echo $banstr;
?>



<?php
ActiveForm::end();
?>
</div>
</div>
