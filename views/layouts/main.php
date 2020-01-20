<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\widgets\SideNav;
use yii\helpers\Url;

$aaaaaa = 1111;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php $this->registerAssetBundle(yii\web\JqueryAsset::className(), 1);?>
		<?= Html::csrfMetaTags() ?>
		<title>Barhopper</title>
		<?php $this->head() ?>
	</head>
	<body style="background-color:#f4f2f2;">
		<?php
		$this->beginBody();
		$avatar = Yii::$app->user->identity->image;

		if ($avatar && file_exists($avatar->filename)) {
			$avatar = "<div class='circular--portrait'><img src='".$avatar->filename."'/></div>";
		}
		else {
			$avatar = "<div class='circular--portrait'><img src='img/avatar.png'/></div>";
		}
		?>
		<div class="wrap" style="display: flex;overflow: hidden;">
			<div style="float: left;width: 231px;height:100vh;background-color: #FFFFFF;background-image: url('img/border.png');">
				<img src="img/logo_main.png"/>
				<div style="padding: 1px 0 0 0;"></div>
				<table border="0" style="width:100%;">
					<tr>
						<td valign="middle" width="89px" height="91px" align="center"><?=$avatar ?></td>
						<td valign="middle">
							<font color="#808080"><?="<b>Welcome,</b><br>" . Yii::$app->user->identity->first_name." ".Yii::$app->user->identity->last_name ?></font></td>
					</tr>
				</table>
				<div style="padding: 1px 0 0 0;"></div>
				<?php

				$activestr = '<img src="img/active.png" class="activeimg"/>';
				$addstr = "";

				if (Yii::$app->controller->action->id == "index" || Yii::$app->controller->action->id == "venue" || Yii::$app->controller->action->id == "user") {
					$addstr = '<img src="img/active.png" class="activeimgfirst"/>';
				}
				$menuItems[] =  ['label' => '<img src="img/profile_ico.png"/ style="padding:6px 20px 6px 0"><font color="#808080">Venue</font>'.$addstr,  'icon' => '', 'url'=>Url::to(['/site/venue'])];

				$addstr = "";
				if (Yii::$app->controller->action->id == "report") {
					$addstr = '<img src="img/active.png" class="activeimgfirst"/>';
				}
				$menuItems[] =  ['label' => '<img src="img/report_ico.png"/ style="padding:6px 20px 6px 0"><font color="#808080">Reports</font>'.$addstr,  'icon' => '', 'url'=>Url::to(['/site/report'])];
				/////////////////////////////////
				
				$addstr = "";
				if (Yii::$app->controller->action->id == "promotion") {
					$addstr = $activestr;
				}
				$menuItems[] =  ['label' => '<img src="img/promotion_ico.png"/ style="padding:6px 20px 6px 0"><font color="#808080">Promotions Feed</font>'.$addstr,  'icon' => '', 'url'=>Url::to(['/site/promotion'])];

				$addstr = "";
				if (Yii::$app->controller->action->id == "shop") {
					$addstr = $activestr;
				}
				$menuItems[] =  ['label' => '<img src="img/shop_ico.png"/ style="padding:6px 20px 6px 0"><font color="#808080">Shop Accounts</font>'.$addstr,  'icon' => '', 'url'=>Url::to(['/site/all'])];

				$addstr = "";
				if (Yii::$app->controller->action->id == "air") {
					$addstr = $activestr;
				}
				$menuItems[] =  ['label' => '<img src="img/air_ico.png"/ style="padding:6px 20px 6px 0"><font color="#808080">Air Time Promotions</font>'.$addstr,  'icon' => '', 'url'=>Url::to(['/site/all'])];
				
				$addstr = "";
				if (Yii::$app->controller->action->id == "setting") {
					$addstr = $activestr;
				}
				$menuItems[] =  ['label' => '<img src="img/settings_ico.png"/ style="padding:6px 20px 6px 0"><font color="#808080">Settings</font>'.$addstr,  'icon' => '', 'url'=>Url::to(['/site/setting'])];

				$addstr = "";
				if (Yii::$app->controller->action->id == "premium") {
					$addstr = $activestr;
				}
				$menuItems[] =  ['label' => '<img src="img/premium_ico.png"/ style="padding:6px 20px 6px 0"><font color="#808080">Premium Placement</font>'.$addstr,  'icon' => '', 'url'=>Url::to(['/site/all'])];



				/////////////////////////////////

				$addstr = "";
				if (Yii::$app->controller->action->id == "all") {
					$addstr = $activestr;
				}
				$menuItems[] =  ['label' => '<img src="img/all_ico.png"/ style="padding:6px 20px 6px 0"><font color="#808080">All Users</font>'.$addstr,  'icon' => '', 'url'=>Url::to(['/site/all'])];
				$addstr = "";
				if (Yii::$app->controller->action->id == "banned") {
					$addstr = $activestr;
				}
				$menuItems[] =  ['label' => '<img src="img/banned_ico.png"/ style="padding:6px 20px 6px 0"><font color="#808080">Banned Users</font>'.$addstr,  'icon' => '', 'url'=>Url::to(['/site/banned'])];
/*				$addstr = "";
				if (Yii::$app->controller->action->id == "change") {
					$addstr = $activestr;
				}

				$menuItems[] =  ['label' => '<img src="img/change_ico.png"/ style="padding:6px 20px 6px 0"><font color="#808080">Change Password</font>'.$addstr,  'icon' => '', 'url'=>Url::to(['/site/change'])];
*/
				$type = SideNav::TYPE_DEFAULT;
				echo SideNav::widget([
					'type' => $type,
					'encodeLabels' => false,
					'items' =>$menuItems,
					'options' => ['style' => 'background-color:#FFFFFF']
				]);

				echo   Html::beginForm(['/site/logout'], 'post')
				.Html::submitButton('', ['class' => 'logout', 'name' => 'logout-button', 'style' => 'position: absolute;bottom: 0;border: 0px solid transparent;width:231px;height:39px;background: url(img/logout.png)'])
				. Html::endForm()

				?>


			</div>
			<div class="container" style="float: left;padding:10px 10px 20px 10px;width: auto;">
				<?= Alert::widget() ?>
				<?php /*if(Yii::$app->controller->action->id != "index") */echo $content ?>
			</div>
		</div>
		<script>
		/*	$(".form ul li input").click(function() {
				$(this).closest("li").css("background-color","yellow");
			});

			$(".form ul li input").blur(function() {
				$(this).closest("li").css("background-color","yellow");
			});*/
		</script>
		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>
