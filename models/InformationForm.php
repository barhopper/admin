<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use app\models\Information;
/**
* LoginForm is the model behind the login form.
*
* @property User|null $user This property is read-only.
*
*/
class InformationForm extends Model
{
	public $id;
	public $owner_id;
	public $email;
	public $name;
	public $location;
	public $phone;
	public $address;
	public $text;


	private $_info = false;

/**
* @return array the validation rules.
*/
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

	public function __construct($id, $config = [])
	{
		$this->_user = Information::findByOwner($id);

		if (!$this->_info) {
			throw new InvalidParamException('Unable to find info!');
		}

		$this->id = $this->_infi->id;
		parent::__construct($config);
	}
	
	public function addInformation()
	{
		$info = new Information();
		$info->name = $this->name;
		$info->text = $this->text;
		$info->email = $this->email;
		$info->owner_id = $this->owner_id;
		$info->location = $this->location;
		$info->phone = $this->phone;
		$info->address = $this->address;

		return $info->save(false);
	}
	
	public function saveInformation()
	{
		$info->name = $this->name;
		$info->text = $this->text;
		$info->email = $this->email;
		$info->owner_id = $this->owner_id;
		$info->location = $this->location;
		$info->phone = $this->phone;
		$info->address = $this->address;

		return $info->save(false);
	}
	public function getInformation($owner_id)
	{
		
		$info = Information::findByOwner($owner_id);
		return $info;
	}
}