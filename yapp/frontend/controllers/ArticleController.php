<?php
namespace frontend\controllers;

use common\models\Article;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class ArticleController extends Controller
{
   

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]

        ];
    }

    /**
     * Displays index.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->params['title'] = 'Психотера - все о психотерапии - Статьи';
        $this->view->params['description'] = 'описание';
        $this->view->params['keywords'] = 'психотерапия, психотерапевт';

        $articles = Article::find()
            ->where(['status'=>'publish'])
            ->andWhere('link2original != :value',['value'=>'masterpage'])
            ->with('psys','sites','tags')
            ->limit(100)
            ->all();
        $articleDataProvider = new ArrayDataProvider([
            'allModels'=>$articles,
            'pagination' => [
                'pageSize' => 10,
            ],
//            'sort' => [
//                'attributes' => ['id', 'username'],
//            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $articleDataProvider,
        ]);
    }

    public function actionView($hrurl)
    {
        Url::remember();
        $this->layout = 'article';
        $article = Article::find()->where(['hrurl'=>$hrurl])->with('psys','sites','tags')->one();
        $this->view->params['title'] = 'Психотера - '. $article['list_name'] .' ('.$article['author'].').';
        $this->view->params['description'] = $article['list_name'].' - '. $article['excerpt'];
        $this->view->params['keywords'] = 'психотерапия, психотерапевт'.$article['excerpt_big'];

        return $this->render('view', [
            'article' => $article,
        ]);
    }



}
