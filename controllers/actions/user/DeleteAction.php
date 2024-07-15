<?php

declare(strict_types=1);

namespace app\controllers\actions\user;

use yii\base\Action;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Deletes an existing User model.
 * If deletion is successful, the browser will be redirected to the 'index' page.
 * @param int $id
 * @return Response
 * @throws NotFoundHttpException if the model cannot be found
 */
class DeleteAction extends Action
{
    public function run($id): Response
    {
       $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}