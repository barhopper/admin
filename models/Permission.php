<?php
namespace app\models;
 
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\data\ActiveDataProvider;

class Permission extends ActiveRecord
{
public static function tableName()
    {
        return '{{%permissions}}';
    }
}