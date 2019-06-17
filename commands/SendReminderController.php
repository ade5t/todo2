<?php

namespace app\commands;

use app\models\Todo;
use yii\console\Controller;
use yii\console\ExitCode;

class SendReminderController extends Controller
{
    public function actionIndex()
    {
        Todo::SendAllMessage();
        return ExitCode::OK;
    }
}
