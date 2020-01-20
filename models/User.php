<?php
namespace app\models;
 
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\data\ActiveDataProvider;
use app\models\Image;
use app\models\UserPermission;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
// 	public $id;
//	public $username;
//	public $password;
//	public $email;
//	public $first_name;
	public $userlist;
	public $avatar;
	public $path;	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }
    
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'avatar_id']);
    }
    
	public function setImage($id, $image_id)
	{
		$user = static::findOne(['id' => $id]);
		$user->avatar_id = $image_id;
		$user->save();
	}    
    
    public function getUserPermission()
    {
        return $this->hasMany(UserPermission::className(), ['user_id' => 'id']);
    }
    
    public function getBan()
    {
        return $this->hasOne(Ban::className(), ['user_id' => 'id']);
    }
       
    public function rules()
    {
        $rules = parent::rules();

        $rules['fieldRequired'] = ['email', 'required'];
        //$rules['fieldRequired'] = ['create_at', 'required'];
        $rules['fieldRequired'] = ['avatar_id', 'integer'];        
        //$rules['fieldRequired'] = ['path', 'string'];    
        $rules['password'] = ['password', 'string', 'min' => 2, 'max' => 72]; 
        return $rules;
    }
 
    /**
     * @inheritdoc
     */
/*    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }*/
     /**
     * @inheritdoc
     */
 /*   public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }*/

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = static::findOne(['id' => $id]);
       /* if($user){
        	$user->avatar = (new \yii\db\Query())
    		 ->select(['path'])
   			 ->from('images')
   			 ->where(['id' => $user->avatar_id])
    		 ->limit(1)
    		 ->one();
		}*/
		return $user;
    }
 
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
 
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['first_name' => $username]);
    }
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    } 
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
 
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
 
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
 ///////////////////////////////// custom
 	
 	public function getUsers()
 	{
 		//$query = "SELECT users.*, images.path  FROM `users` LEFT JOIN images ON images.id = users.avatar_id WHERE users.id NOT IN (SELECT user_id FROM user_bans) ORDER BY users.first_name";
		//$this->userlist = static::findBySql($query)->all();
		//$test =	User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->leftJoin('images', 'users.avatar_id = images.id')->orderBy('users.first_name') ,
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);		

        return $dataProvider;
	}

 	public function getBannedUsers()
 	{
 		$query = "SELECT users.*, images.path  FROM `users` LEFT JOIN images ON images.id = users.avatar_id ORDER BY users.first_name";
		$this->userlist = static::findBySql($query)->all();
	}
	
	public function getByOwner($id)
	{
		$query = "SELECT * FROM users WHERE `owner_id` = '".$id."'";
		$cats = static::findBySql($query)->all();
	}	
	
 	public function getSearchUsers($filter)
 	{
 		$query = "SELECT * FROM `categories` WHERE `title` LIKE '%pp%'";
		$cats = static::findBySql($query)->all();
	}	
 /////////////////////////////////
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
       //return Yii::$app->security->validatePassword($password, $this->password);
        return $this->password === md5($password);
    }
 
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
       // $this->password = Yii::$app->security->generatePasswordHash($password);
		$this->password = md5($password);
    }
 
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
 
}