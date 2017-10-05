<?php

namespace backend\controllers;

use common\models\DailyCount;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

class CountController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $dataProvider = new  ActiveDataProvider([
            'query' => DailyCount::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
