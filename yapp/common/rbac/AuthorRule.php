<?php


namespace common\rbac;


use yii\rbac\Rule;

class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string|integer $user ID пользователя.
     * @param Item $item роль или разрешение с которым это правило ассоциировано
     * @param array $params параметры, переданные в ManagerInterface::checkAccess(), например при вызове проверки
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */

    public function execute($userId,$item,$params)
    {
        // проверяем, что поле createdBy у новости совпадает ли с user id
        return isset($params['news']) ? $params['news']->createdBy == $userId : false;

    }
}