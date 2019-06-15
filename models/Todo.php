<?php

namespace app\models;

use Yii;

class Todo extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            ['title','string','min'=>1,'max'=>255],
            ['description','string','min'=>1,'max'=>255],
        ];
    }

    public static function tableName()
    {
        return 'todo';
    }

    public static function getAll()
    {
//        Получение выборки всех задач для пользователя с заданным id
        $data = self::find()->where(['id_user' => Yii::$app->user->getId()])->all();
        return $data;
    }

    public static function getOne($id)
    {
//        Получение одной конкретной задачи по ее id
        $data = self::find()->where(['id' => $id])->one();
        return $data;
    }
}
