<?php

namespace app\controllers;

use Yii;
use app\models\Join;
use app\models\Login;
use app\models\Todo;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionJoin()
    {
        if (Yii::$app->user->isGuest) {
            $model_join = new Join();

            if (isset($_POST['Join'])) {
                $model_join->attributes = Yii::$app->request->post('Join');
                if ($model_join->validate() && $model_join->signup()) {
                    Yii::$app->user->login($model_join->getUser());
                    return $this->redirect(['site/todo']);
                }
            }
            return $this->render('join', ['model' => $model_join]);
        } else return $this->redirect(['site/todo']);
    }

    public function actionLogin()
    {
        if (Yii::$app->user->isGuest){
            $model_login = new Login();

            if(Yii::$app->request->post('Login'))
            {
                $model_login->attributes = Yii::$app->request->post('Login');
                if($model_login->validate())
                {
                    Yii::$app->user->login($model_login->getUser());
                    return $this->redirect(['site/todo']);
                }
            }
            return $this->render('login', ['model' => $model_login]);
        }
        else return $this->redirect(['site/todo']);
    }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }

    public function actionTodo()
    {
        $todo_list = Todo::getAll();
        $model_todo = new Todo();

        if ($_POST['Create'])
        {
            $model_todo->title = $_POST['Todo']['title'];
            $model_todo->description = $_POST['Todo']['description'];
            $model_todo->id_user = Yii::$app->user->getId();
            $model_todo->is_completed = false;
            if ($model_todo->validate() && $model_todo->save())
            {
                return $this->redirect(['site/todo']);
            }
        }
        return $this->render('todo', ['model2'=>$todo_list, 'model'=>$model_todo]);
    }

    public function actionDelete($id){
        $model_delete = Todo::getOne($id);

        $model_delete->delete();
        return $this->redirect(['site/todo']);
    }

    public function actionCompleted($id){
        $model_completed = Todo::getOne($id);

        $model_completed->is_completed = !$model_completed->is_completed;
        if ($model_completed->validate() && $model_completed->save())
        {
            return $this->redirect(['site/todo']);
        }
    }

    public function actionEdit($id){
        $model_edit = Todo::getOne($id);

        if ($_POST['Edit'])
        {
            $model_edit->title = $_POST['Todo']['title'];
            $model_edit->description = $_POST['Todo']['description'];
            if ($model_edit->validate() && $model_edit->save())
            {
                return $this->redirect(['site/todo']);
            }
        }
        return $this->render('edit', ['model'=>$model_edit]);
    }

}
