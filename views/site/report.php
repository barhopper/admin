<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

$this->title = 'Reports';

$form = ActiveForm::begin([
    'method' => 'get',
    'action' => ['report'],
]);

?>
<div class="site-all" align="center">
    <img src="img/line_reports.png"/>
    <div style="padding: 20px 0px;">
</div>
<?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_report',
    'layout' => "<div style='background-image: url(img/grey_line.png);width:484px;height:1px;'></div>{items}<div style='background-image: url(img/grey_line.png);width:484px;height:1px;'></div>{pager}",
    'summary' => "Showing {begin}-{end} of {totalCount} Reports.",
    'emptyText' => 'Reports not found',
]);


?>
</div>
<?php
	ActiveForm::end();
?>
