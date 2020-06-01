<?php

namespace app\modules\api\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;

/**
 * Управление пользователями через апи
 */
class UserController extends \yii\rest\Controller
{
    /** @inheritdoc */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ]
        ];

        return $behaviors;
    }

    /**
     * @return \yii\data\ActiveDataProvider
     */
    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => \app\models\User::find()
        ]);

        return $dataProvider;
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {
        $data = Yii::$app->request->getBodyParams();

        $user = new User();
        if ($user->load($data, '') && $user->validate()) {
            if ($user->save()) {
                Yii::$app->response->setStatusCode(201);
            }
        }

        return $user;
    }
}