<?php

namespace backend\controllers;

use common\models\ReadWithIt;
use yii\data\ActiveDataProvider;

class ReadWithItController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $dataProvider = new  ActiveDataProvider([
            'query' => ReadWithIt::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
