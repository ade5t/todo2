<?php

namespace app\models;

use yii\base\Model;

class Login extends Model
{
    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login','password'],'required'],
            ['login','string','min'=>5,'max'=>20],
            ['password','validatePassword'],
            ['password','string','min'=>5,'max'=>20]
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $user = $this->getUser();

            if(!$user || !$user->validatePassword($this->password))
            {
                $this->addError($attribute, 'Wrong username or password');
            }
        }
    }

    public  function getUser()
    {
        return User::findOne(['login'=>$this->login]);
    }

}