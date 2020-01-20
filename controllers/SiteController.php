<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\InformationForm;
use app\models\ContactForm;
use app\models\UserForm;
use app\models\ChangeForm;
use app\models\ForgotForm;
use app\models\PersonalForm;
use app\models\ResetForm;
use app\models\Information;
use app\models\User;
use app\models\SearchUser;
use app\models\Report;
use app\models\Profile;
use app\models\Promotion;
use app\models\Token;
use app\models\Image;
use yii\base\InvalidParamException;
use yii\helpers\Url;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
			    'rules' => [
			        [
			            'allow' => true,
			            'actions' => ['login', 'forgot', 'send', 'reset', 'add'],
			        ],
			        [
			            'allow' => true,
			            'roles' => ['@'],
			        ],
			    ],
			    'denyCallback' => function () {
			        return Yii::$app->response->redirect(['site/login']);
			    },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->actionVenue();
        //return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        $this->layout = 'login';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionForgot()
    {
        $model = new ForgotForm();
        $model->mess = '';
        $this->layout = 'login';
        if(($model->load(Yii::$app->request->post()) || $model->load(Yii::$app->request->get())) && $model->validate()){
			$command = Yii::$app->db->createCommand('DELETE FROM user_tokens WHERE user_id = :id')->bindParam(':id', $model->id);
			$command->execute();
                
            $getToken = rand(0, 99999);
            $getTime = date("H:i:s");
            $token = md5($getToken.$getTime);
                
			$command = Yii::$app->db->createCommand('INSERT INTO user_tokens (user_id, create_at, token) VALUES (:id, Now(), :token)')->bindParam(':id', $model->id)->bindValue(':token', $token);
			$command->execute();
			$email = $model->email;

            $admin = Yii::$app->params['adminEmail'];
            $subject = "Reset Password";
            $title = "You have successfully reset your password<br/><br/>
                <a href='".Url::to(['site/reset'], true)."?token=".$token."'>Click Here to save new Password</a>";
			$subject='=?UTF-8?B?'.base64_encode($subject).'?=';
			$headers="From: Barhopper <{$admin}>\r\n".
				"Reply-To: {$admin}\r\n".
				"MIME-Version: 1.0\r\n".
				"Content-type: text/html; charset=UTF-8";

			mail($email, $subject, $title, $headers);
			if(Yii::$app->request->get('silent') == 'true'){
				echo "Ok";
				exit;
			}
			$model->mess = 'Link to reset your password has been sent to your email';
			return $this->render('send', [
		    	'model' => $model,
		    ]);	        
		}
       
		return $this->render('forgot', [
	    	'model' => $model,
	    ]);
    }

    public function actionReset()
    {
    	$token = Yii::$app->request->get('token');
    	$model = Token::find()
    		->where(['token' => Yii::$app->request->get('token')])
    		->andWhere('Now() - create_at < 3600')//30 minutes
    		->one();
        if(!$model){
        	$this->layout = 'login';
        	$model = new ForgotForm();
        	$model->mess = 'Incorrecr token';
	        return $this->render('send', [
	            'model' => $model,
	        ]);
		}
	    try {
	    	$id = $model->user_id;
	    	$email = $model->user->email;
	        $model = new ResetForm($id);
	        //$model->email = $email;
	    } catch (InvalidParamException $e) {
	        throw new \yii\web\BadRequestHttpException($e->getMessage());
	    }
    
	    if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->changePassword()/* && $model->login()*/) {
			$command = Yii::$app->db->createCommand('DELETE FROM user_tokens WHERE user_id = :id')->bindParam(':id', $id);
			$command->execute();	
        	$this->layout = 'login';
        	$model = new ForgotForm();
        	$model->mess = 'Password saved';
	        return $this->render('send', [
	            'model' => $model,
	        ]);
	    }			
        $this->layout = 'login';
        return $this->render('reset', [
            'model' => $model,
        ]);
    }      
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAll()
    {
    	$id = Yii::$app->request->get('removeban');
		if($id){
			$command = Yii::$app->db->createCommand('DELETE FROM user_bans WHERE user_id = :user_id')->bindParam(':user_id', $id);
			$command->execute();
		}		
		
    	$searchModel = new SearchUser();
    	$dataProvider = $searchModel->search(['SearchUser' => ['first_name' => Yii::$app->request->get('username')]]);
//    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('all', [
        	'model' => $searchModel,
        	'dataProvider' => $dataProvider,            
        ]);
    } 
    public function actionReport()
    {
    	$searchModel = new Report();
    	$dataProvider = $searchModel->search();
        return $this->render('report', [
        	'model' => $searchModel,
        	'dataProvider' => $dataProvider,            
        ]);
    } 
	public function actionVenue()
	{
		$id = \Yii::$app->user->id;
		try {
			$model = Information::findByOwner($id);
		}
		catch (InvalidParamException $e) {
			throw new \yii\web\BadRequestHttpException($e->getMessage());
		}

		return $this->render('venue', [
		'model' => $model,
		]);
	}   
	public function actionService()
	{
		$searchModel = new Profile();
		$dataProvider = $searchModel->search();
		if (Yii::$app->request->post() && Yii::$app->request->post('action') == 'new') {
		}
		return $this->render('service', [
			'model' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	} 
	public function actionReview()
	{
		$searchModel = new Profile();
		$dataProvider = $searchModel->search();
		if (Yii::$app->request->post() && Yii::$app->request->post('action') == 'new') {
		}
		return $this->render('review', [
			'model' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	} 
	public function actionFeed()
	{
		$searchModel = new Profile();
		$dataProvider = $searchModel->search();
		if (Yii::$app->request->post() && Yii::$app->request->post('action') == 'new') {
		}
		return $this->render('feed', [
			'model' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	} 
	public function actionSetting()
	{
		$id = \Yii::$app->user->id;
		try {
			$model = new ChangeForm($id);
		}
		catch (InvalidParamException $e) {
			throw new \yii\web\BadRequestHttpException($e->getMessage());
		}
		try {
			$personal = new PersonalForm($id);
		}
		catch (InvalidParamException $e) {
			throw new \yii\web\BadRequestHttpException($e->getMessage());
		}

		if (\Yii::$app->request->post()) {
			if (Yii::$app->request->post('action') == 'change') {
				if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {
					return $this->redirect(['setting']);
				}
			}
			if (Yii::$app->request->post('action') == 'edit') {
				if ($personal->load(\Yii::$app->request->post()) && $personal->validate() && $personal->saveUser()) {
					return $this->redirect(['setting']);
				}
			}
			if (Yii::$app->request->post('action') == 'upload') {
				$name = $_FILES["avatar"]["name"];
				$tmpname = $_FILES["avatar"]["tmp_name"];
				$path = 'images/avatar_'.$id.'_' . $name;
				if (move_uploaded_file($tmpname, $path)) {
					$image = new Image();
					$image->filename = $path;
					$image->create_at = date('Y-m-d H:i:s');
					$image->save();
					$imageid = $image->id;
					User::setImage($id, $imageid);
					return $this->redirect(['setting']);
				}
			}
		}

		$users = SearchUser::findByOwner($id);

		return $this->render('setting', [
			'model' => $model,
			'users' => $users,
			'personal' => $personal,
		]);	
//		$searchModel = new Profile();
//		$dataProvider = $searchModel->search();
//		if (Yii::$app->request->post() && Yii::$app->request->post('action') == 'new') {
//		}
//		return $this->render('setting', [
//			'model' => $model,
//		]);
	} 	
	
	public function actionDeleteuser()
	{
		$id = \Yii::$app->user->id;
		try {
			$model = new UserForm($id);
		}
		catch (InvalidParamException $e) {
			throw new \yii\web\BadRequestHttpException($e->getMessage());
		}

		$deleteid = Yii::$app->request->get('id');
		if ($id) {
			$command = Yii::$app->db->createCommand('DELETE FROM users WHERE owner_id = :owner_id AND id = :id')->bindParam(':owner_id', $id)->bindParam(':id', $deleteid);
			$command->execute();
		}
		return $this->redirect(['setting']);		
	}
	
	public function actionChangerole()
	{
		$id = \Yii::$app->user->id;
		try {
			$model = new UserForm($id);
		}
		catch (InvalidParamException $e) {
			throw new \yii\web\BadRequestHttpException($e->getMessage());
		}

		$userid = Yii::$app->request->get('id');
		$roleid = Yii::$app->request->get('role');
		if ($roleid != '1' && $roleid != '2') {
			if ($userid && $roleid) {
				$command = Yii::$app->db->createCommand('UPDATE users SET role_id = :role_id WHERE owner_id = :owner_id AND id = :id')->bindParam(':role_id', $roleid)->bindParam(':owner_id', $id)->bindParam(':id', $userid);
				$command->execute();
			}
		}
		return $this->redirect(['setting']);
	}

	public function actionEditinformation()
	{
		$id = \Yii::$app->user->id;

		$model = Information::findByOwner($id);

		if (Yii::$app->request->post()) {
			if (!$model) {
				$model = new Information();
			}
			if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

				$model->owner_id = $id;
				$model->save();
			}
			return $this->redirect(['venue']);
		}
		//$model = new InformationForm();
		/*
				if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
					$model->role_id = Yii::$app->request->post('role');
					if ($model->role_id < 3)
						$model->addError('role', 'Incorrect role.');
					else {
						$model->owner_id = $id;
						$model->addUses();
						return $this->redirect(['setting']);
					}
				}
		*/		

		return $this->render('editinformation', [
			'model' => $model,
		]);
	} 		
	
	public function actionAdduser()
	{
		$id = \Yii::$app->user->id;
		try {
			$model = new UserForm($id);
		}
		catch (InvalidParamException $e) {
			throw new \yii\web\BadRequestHttpException($e->getMessage());
		}
		if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
			$model->role_id = Yii::$app->request->post('role');
			if ($model->role_id < 3)
				$model->addError('role', 'Incorrect role.');
			else {
				$model->owner_id = $id;
				$model->addUses();
				return $this->redirect(['setting']);
			}
		}
		return $this->render('adduser', [
			'model' => $model,
		]);
	} 	
	public function actionGallery()
	{
		$searchModel = new Profile();
		$dataProvider = $searchModel->search();
		if (Yii::$app->request->post() && Yii::$app->request->post('action') == 'new') {
		}
		return $this->render('gallery', [
			'model' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	} 				  
    
	public function actionPromotion()
	{
		$searchModel = new Promotion();
		$dataProvider = $searchModel->search();
		return $this->render('promotion', [
			'model' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}     
     public function actionUser()
    {
		//$model = User::find()->where(['id' => Yii::$app->request->get('id')])->one();
        //return $this->render('user', [
       // 	'model' => $model,       
        //]);
        $usermodel = User::find()->where(['id' => Yii::$app->request->get('id')])->one();
    	$searchModel = new Report();
    	$dataProvider = $searchModel->searchByUser(Yii::$app->request->get('id'));
        return $this->render('user', [
        	'model' => $searchModel,
        	'dataProvider' => $dataProvider,
        	'userModel' => $usermodel,            
        ]);
    }    
    public function actionDetails()
    {
        $usermodel = User::find()->where(['id' => Yii::$app->request->get('user_id')])->one();
    	$searchModel = new Report();
    	$dataProvider = $searchModel->searchReport(Yii::$app->request->get('id'));
        return $this->render('details', [
        	'model' => $searchModel,
        	'dataProvider' => $dataProvider,
        	'userModel' => $usermodel,            
        ]);
    }    
    public function actionBanned()
    {
		$id = Yii::$app->request->get('removeban');
		if($id){
			$command = Yii::$app->db->createCommand('DELETE FROM user_bans WHERE user_id = :user_id')->bindParam(':user_id', $id);
			$command->execute();
		}		

    	$searchModel = new SearchUser();
    	$dataProvider = $searchModel->searchBan(['SearchUser' => ['first_name' => Yii::$app->request->get('username')]]);
//    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('ban', [
        	'model' => $searchModel,
        	'dataProvider' => $dataProvider,            
        ]);
    } 
    
    public function actionBan()
	{
		$id = Yii::$app->request->get('id');
		if($id){
			$command = Yii::$app->db->createCommand('INSERT INTO user_bans (user_id, `date`, `type`) VALUES (:id, Now(), 0)')->bindParam(':id', $id);
			$command->execute();
		}

		//Yii::$app->db->createCommand()->insert('user_bans', ['user_id' => 'Sam',  'age' => 30])->execute();
        return $this->actionAll();//$this->goHome();	
	}    
	
    public function actionChange()
    {
    	$id = \Yii::$app->user->id;
	    try {
	        $model = new ChangeForm($id);
	    } catch (InvalidParamException $e) {
	        throw new \yii\web\BadRequestHttpException($e->getMessage());
	    }
	    if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {
	        $this->goHome();
	    }	    
        return $this->render('change', [
            'model' => $model,
        ]);	
    }    

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionAdd() {
        $model = User::find()->where(['email' => 'test3@test.com'])->one();
        if (empty($model)) {
            $user = new User();
            $user->first_name = 'test3';
            $user->last_name = 'test3';
            $user->email = 'test3@test.com';
            $user->avatar_id = '3';
            $user->setPassword('123');
            //$user->generateAuthKey();
            if ($user->save()) {
                echo 'good';
            }
        }
    }
}
