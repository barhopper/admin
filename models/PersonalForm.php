<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use app\models\Image;

/**
* LoginForm is the model behind the login form.
*
* @property User|null $user This property is read-only.
*
*/
class PersonalForm extends Model
{
	public $first_name;
	public $last_name;
	public $email;
	public $filename = '';	
	public $password;
	public $confirm_password;
	public $role_id;
	public $id;
	public $owner_id;

	private $_user = false;

	public function __construct($id, $config = [])
	{
		$this->_user = User::findIdentity($id);

		if (!$this->_user) {
			throw new InvalidParamException('Unable to find user!');
		}

		$this->id = $this->_user->id;
		$this->first_name = $this->_user->first_name;
		$this->last_name = $this->_user->last_name;
		$image = Image::findById($this->_user->avatar_id);
		if ($image)
			$this->filename = $image->filename;

		parent::__construct($config);
	}
/**
* @return array the validation rules.
*/
	public function rules()
	{
		return [
			['last_name', 'string'],
			[['first_name'], 'required'],
		];
	}
	public function findByEmail($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$user = User::findByEmail($this->email);

			if ($user) {
				$this->addError($attribute, 'Email allredy in use');
			}
		}
	}
	public function findPasswords($attribute, $params)
	{
		$user = $this->_user;
		$pass = $user->password;
		$pass2 = md5($this->password);
		if ($user->password != md5($this->password))
			$this->addError($attribute, 'Password is incorrect.');
	}

	public function saveUser()
	{
		$user = $this->_user;

		$user->first_name = $this->first_name;
		$user->last_name = $this->last_name;

		return $user->save(false);
	}

	public function addUses()
	{
		$user = new User();
		$user->first_name = $this->first_name;
		$user->last_name = $this->last_name;
		$user->email = $this->email;
		$user->role_id = $this->role_id;
		$user->owner_id = $this->owner_id;
		$user->setPassword($this->password);

		return $user->save(false);
	}

/**
* Validates the password.
* This method serves as the inline validation for password.
*
* @param string $attribute the attribute currently being validated
* @param array $params the additional name-value pairs given in the rule
*/
	public function validatePassword($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();

			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, 'Incorrect password.');
			}

		}
	}

/**
* Logs in a user using the provided username and password.
* @return bool whether the user is logged in successfully
*/
	public function login()
	{
		if ($this->validate()) {
			return Yii::$app->user->login($this->getUser(), /*$this->rememberMe ? 3600*24*30 :*/ 0);
		}
		return false;
	}

/**
* Finds user by [[email]]
*
* @return User|null
*/
	public function getUser()
	{
		if ($this->_user === false) {
			$this->_user = User::findByEmail($this->email);
		}
		return $this->_user;
	}
}