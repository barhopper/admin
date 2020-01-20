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

class Information extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%informations}}';
	}
	public function rules()
	{
		return [
			['email', 'email'],
			[['name'], 'required'],
			['text', 'string'],
			['location', 'string'],
			['phone', 'string'],
			['address', 'string'],
		];
	}
	public static function findByOwner($id)
	{
		$query = static::find()->where(['owner_id' => $id])->one();
		return $query;
	}	
}