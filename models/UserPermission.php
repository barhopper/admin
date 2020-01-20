<?php
namespace app\models;
 
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\data\ActiveDataProvider;
use app\models\Permission;

class UserPermission extends ActiveRecord
{
public static function tableName()
    {
        return '{{%user_permissions}}';
    }

    public function getPermission()
    {
        return $this->hasOne(Image::className(), ['id' => 'permission_id']);
    }
}

