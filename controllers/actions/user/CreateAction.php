<?php

declare(strict_types=1);

namespace app\controllers\actions\user;

use app\models\User;
use yii\base\Action;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Displays a single User model.
 * @param int $id
 * @return string
 * @throws NotFoundHttpException if the model cannot be found
 */
class ViewAction extends Action
{
    public function run($id): Stringable|string
    {
        /**
         * Displays a single User model.
         * @param int $id
         * @return string
         * @throws NotFoundHttpException if the model cannot be found
         */

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
}