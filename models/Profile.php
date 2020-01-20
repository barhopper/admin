<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\data\ActiveDataProvider;
use app\models\Image;
use app\models\User;

class Profile extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%profiles}}';
	}

	public function getImage()
	{
		return $this->hasOne(Image::className(), ['id' => 'image_id']);
	}
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'owner_id']);
	}
	public function search()
	{
		$query = Report::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query ,
			'pagination' => [
				'pageSize' => 20,
			],
		]);
		//   $rrr = User::getRawSql();

		$query->orderBy([
			'date' => SORT_DESC,
		]);
		return $dataProvider;
	}
	public function searchReport($id)
	{
		$query = Report::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query ,
			'pagination' => [
				'pageSize' => 20,
			],
		]);
		//   $rrr = User::getRawSql();
		$query->andFilterWhere(['=', "id", $id]);
		$query->orderBy([
			'date' => SORT_DESC,
		]);
		return $dataProvider;
	}
	public function searchByUser($id)
	{
		$query = Report::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query ,
			'pagination' => [
				'pageSize' => 20,
			],
		]);
		//   $rrr = User::getRawSql();
		$query->andFilterWhere(['=', "owner_id", $id]);
		$query->orderBy([
			'date' => SORT_DESC,
		]);
		return $dataProvider;
	}
}