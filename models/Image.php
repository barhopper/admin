<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\data\ActiveDataProvider;

class Image extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%images}}';
	}
	public function findById($id)
	{
		return static::findOne(['id' => $id]);
	}
}