<?php

declare(strict_types=1);

namespace app\controllers\actions\user;

use app\models\User;
use yii\base\Action;
use yii\db\Exception;
use yii\web\Response;

/**
 * Creates a new User model.
 * If creation is successful, the browser will be redirected to the 'view' page.
 * @return string|Response
 */
class CreateAction extends Action
{
    /**
     * @throws Exception
     */
    public function run(): Response
    {
        $model = new User();

        if ($this->controller->request->isPost) {
            if ($model->load($this->controller->request->post()) && $model->save()) {
                return $this->controller->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->controller->redirect('create', [
            'model' => $model,
        ]);
    }
}