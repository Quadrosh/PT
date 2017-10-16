<?php

namespace common\models;




class MasterQuery extends \yii\db\ActiveQuery
{
    public function byPros($id)
    {
        $junction_table = '{{%item_assign}}';
        $this
            ->innerJoin($junction_table, Master::tableName().'.id='.$junction_table.'.master_id')
            ->where([$junction_table.'.item_id'=>$id])
            ->andWhere([$junction_table.'.item_type'=>'pro']);
    }

    public function byPsys($id)
    {
        $junction_table = '{{%item_assign}}';
        $this
            ->innerJoin($junction_table, Master::tableName().'.id='.$junction_table.'.master_id')
            ->where([$junction_table.'.item_id'=>$id])
            ->andWhere([$junction_table.'.item_type'=>'psy']);
    }

    public function orderByCity($sort_type = SORT_DESC)
    {
        return $this
            ->orderBy(['city'=>$sort_type]);
    }

    /**
     * @inheritdoc
     * @return Master[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    public function one($db = null)
    {
        return parent::one($db);
    }
}


//return $this->hasMany(ProfessionItem::className(),['id'=>'item_id'])
//    ->viaTable('item_assign',['master_id'=>'id'],function($query){
//        $query->andWhere(['item_type'=>'pro']);
//    });