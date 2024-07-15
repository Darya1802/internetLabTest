<?php

declare(strict_types=1);

namespace app\controllers\actions\user;

use yii\base\Action;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use function intval;

/**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
class UpdateAction extends Action
{
    public function run($id): Response
    {
       $model = $this->controller->findModel(intval($id));

        if ($this->controller->request->isPost && $model->load($this->controller->request->post()) && $model->save()) {
            return $this->controller->redirect(['view', 'id' => $model->id]);
        }

        return $this->controller->redirect(['update',['id' => $model->id]]);
    }
}