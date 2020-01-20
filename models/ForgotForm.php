<?php
 
namespace app\models;
 
use Yii;
use yii\base\Model;
use app\models\User;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ForgotForm extends Model
{
    public $email;
    public $id;
    public $mess;
    
    private $_user = false;
 
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            ['email','findByEmail'],
        ];
    }
	
    public function changePassword()
    {
        $user = $this->_user;


        $user->setPassword($this->new_password);
 
        return $user->save(false);
    }
 
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function findByEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findByEmail($this->email);
 			
            if (!$user) {
                $this->addError($attribute, 'ユーザー名かパスワードが無効です。');
            }else{
				$this->id = $user->id;
			}
 
        }
    }
}
