<?php

declare(strict_types=1);

namespace app\controllers\actions\user;

use app\controllers\UserController;
use yii\base\Action;
use yii\web\NotFoundHttpException;
use function intval;

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
        return $this->controller->render('view', [
            'model' => $this->controller->findModel(intval($id)),
        ]);
    }
}