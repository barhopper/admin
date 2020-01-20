<?php

namespace app\models;
 
use Yii;
use yii\base\Model;
use app\models\User;
use yii\data\ActiveDataProvider;
use app\models\Image;

class SearchUser extends User
{
	public $filename;	
	public function rules()
	{
	    return [
	        ['first_name', 'string'],
	    ];
	}

	public function scenarios()
	{
	    // bypass scenarios() implementation in the parent class
	    return Model::scenarios();
	}

	public function findByOwner($id)
	{
		$query = static::find();
		return $query->select('users.*, filename')->leftJoin('images', 'users.avatar_id = images.id')->where(['owner_id' => $id])->orderBy('users.first_name')->all();
	}
		
	public function search($params)
	{
	    $query = User::find();

	    //$dataProvider = new ActiveDataProvider(['query' => $query]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query ,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);	
         //   $rrr = User::getRawSql();
	    if (!($this->load($params) && $this->validate())) {
	        return $dataProvider;
	    }
	    /*$sql = 'SELECT `user_id` FROM user_bans';
		$model = Ban::findBySql($sql)->all();
		$list = array();
		for($i = 0; $i < count($model); $i++)
			$list[] = $model[$i]->user_id;;
	    $query->where(['NOT IN', "id" , $list]);*/	  
	    $query->andFilterWhere(['like', "first_name", $this->first_name]);
	    $query->orderBy('first_name');
	    return $dataProvider;
	}
	
	public function searchBan($params)
	{
	    $query = User::find();

	    //$dataProvider = new ActiveDataProvider(['query' => $query]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query ,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);	
  
	    if (!($this->load($params) && $this->validate())) {
	        return $dataProvider;
	    }
	    $sql = 'SELECT `user_id` FROM user_bans';
		$model = Ban::findBySql($sql)->all();
		$list = array();
		for($i = 0; $i < count($model); $i++)
			$list[] = $model[$i]->user_id;;
	    $query->where(["id" => $list]);	    
	    $query->andFilterWhere(['like', "first_name", $this->first_name]);
		$query->orderBy('first_name');

	    return $dataProvider;
	}	
}