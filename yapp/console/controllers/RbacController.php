<?php


namespace console\controllers;
use common\rbac\AuthorRule;
use Yii;
use yii\console\Controller;


class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //обнуляем БД

        // создаем роли
        $admin = $auth->createRole('admin');
        $editor = $auth->createRole('editor');
        $author = $auth->createRole('author');

        // вносим роли в БД
        $auth->add($admin);
        $auth->add($editor);
        $auth->add($author);

        // Создаем экземпляр правила проверки автора
        $authorRule = new AuthorRule();

        // вносим в БД
        $auth->add($authorRule);


        // создаем разрешения
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $updateArticle = $auth->createPermission('updateArticle');
        $updateArticle->description = 'Редактирование статьи';

        $updateOwnArticle = $auth->createPermission('updateOwnArticle');
        $updateOwnArticle->description = 'Редактирование собственной статьи';

        // указываем правило AuthorRule для разрешения updateOwnArticle
        $updateOwnArticle->ruleName = $authorRule->name;

        // вносим разрешения в БД
        $auth->add($viewAdminPage);
        $auth->add($updateArticle);
        $auth->add($updateOwnArticle);

        // автору присваиваем разрешение $updateOwnArticle
        $auth->addChild($author,$updateOwnArticle);

        // редактору присваиваем разрешение $updateArticle
        $auth->addChild($editor,$updateArticle);

        // админ наследует роль редактора
        $auth->addChild($admin,$editor);

        // админу присваиваем разрешение $viewAdminPage
        $auth->addChild($admin,$viewAdminPage);

        // назначаем роли пользователям по id
        $auth->assign($admin,1);
        $auth->assign($editor,3);
        $auth->assign($author,2);

    }
}


// // Проверка если может
//if (!\Yii::$app->user->can('updateNews')) {
//    throw new ForbiddenHttpException('Access denied');
//}



//// Назначение роли для динамически добавляемых пользователей - в методе afterSave модели User
//$auth = Yii::$app->authManager;
//$editor = $auth->getRole('editor'); // Получаем роль editor
//$auth->assign($editor, $this->id); // Назначаем пользователю, которому принадлежит модель User




////что бы вызвать проверку прав на редактирование собственной новости, в экшене редактирования производим проверку:
//if (!\Yii::$app->user->can('updateOwnNews', ['news' => $newsModel])) {
//    throw new ForbiddenHttpException('Access denied');
//}