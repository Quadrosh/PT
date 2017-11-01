<?php


namespace console\controllers;
use console\models\InitElastic;
use Yii;

class ElasticController extends \yii\console\Controller
{
    public function actionIndex()
    {
//        for ($i=0; $i<5; $i++) {
//            $articleElastic = new ArticleElastic();
//            $articleElastic->attributes = ['name' => 'article name ' . $i];
//            $articleElastic->save();
//        }
//        $articleElastic = new ArticleElastic();
//        $articleElastic->save();
    }

    public function actionInit()
    {
        $articleElastic = new InitElastic();
        $articleElastic->save();
    }

}

// php yii elastic/init