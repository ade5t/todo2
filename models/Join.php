<?php

namespace app\models;

use yii\base\Model;

class Join extends Model
{
    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login','password'],'required'],
            ['login','string','min'=>5,'max'=>20],
            ['login','unique','targetClass'=>'app\models\User'],
            ['password','string','min'=>5,'max'=>20]
        ];
    }

    public function signup()
    {
        $user = new User();
        $user->login = $this->login;
        $user->setPassword($this->password);
        return $user->save();
    }

    public  function getUser()
    {
        return User::findOne(['login'=>$this->login]);
    }
}