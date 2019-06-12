<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\Url;

class Join extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email','password'],'required'],
            ['email','email'],
            ['email','unique','targetClass'=>'app\models\User'],
            ['password','string','min'=>5,'max'=>20]
        ];
    }

    public function signup()
    {
        $user = new User();
        $user->email = $this->email;
        $user->status = 0;
        try {
            $user->email_confirm_token = Yii::$app->security->generateRandomString();
        } catch (Exception $e) {
        }
        $user->setPassword($this->password);
        if ($this->send_message($user->email, $user->email_confirm_token)){
            return $user->save();
        }
        else return false;
    }

    public function send_message($email, $token){
        $absoluteHomeUrl = Url::home(true); //http://сайт
        $serverName = Yii::$app->request->serverName; //сайт без http
        $url = $absoluteHomeUrl.'activation/'.$token;

        $msg = "Hello! Thank you for using the site $serverName! You only need to confirm your email. To do this, follow the link: $url";

        $msg_html  = "<html><body style='font-family:Arial,sans-serif;'>";
        $msg_html .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>Hello! Thank you for using the site <a href='". $absoluteHomeUrl ."'>$serverName</a></h2>\r\n";
        $msg_html .= "<p><strong>You only need to confirm your email.</strong></p>\r\n";
        $msg_html .= "<p><strong>To do this, follow the link: </strong><a href='". $url."'>$url</a></p>\r\n";
        $msg_html .= "</body></html>";

        try{
            Yii::$app->mailer->compose()
                ->setFrom('todo2.reg@yandex.ru')
                ->setTo($email)
                ->setSubject('Account Verification')
                ->setTextBody($msg)
                ->setHtmlBody($msg_html)
                ->send();
        }
        catch (\Exception $e){
            Yii::$app->session->setFlash('error', "Unable to send account verification email to this email.");
        }
        return true;
    }

    public function confirm($token){
        $user = $this->getUserByToken($token);
        if ($user != null){
            $user->email_confirm_token = '';
            $user->status = 1;
            return $user->save();
        }
        else return false;
    }

    public function getUser()
    {
        return User::findOne(['email'=>$this->email]);
    }

    public function getUserByToken($token)
    {
        return User::findOne(['email_confirm_token'=>$token]);
    }
}