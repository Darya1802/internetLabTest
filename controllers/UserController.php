<?php

namespace app\controllers;

use app\controllers\actions\user\CreateAction;
use app\controllers\actions\user\DeleteAction;
use app\controllers\actions\user\IndexAction;
use app\controllers\actions\user\UpdateAction;
use app\controllers\actions\user\ViewAction;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function actions(): array
    {
        return [
            'index' => IndexAction::class,
            'view' => ViewAction::class,
            'create' => CreateAction::class,
            'update' => UpdateAction::class,
            'delete' => DeleteAction::class
        ];
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel(int $id): User
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
