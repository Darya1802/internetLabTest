<?php

declare(strict_types=1);

namespace app\controllers\actions\user;

use app\models\User;
use yii\base\Action;
use yii\data\ActiveDataProvider;

class IndexAction extends Action
{
    public function run(): Stringable|string
    {
         $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->controller->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}