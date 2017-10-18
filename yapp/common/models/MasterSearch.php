<?php

namespace common\models;



use yii\data\ActiveDataProvider;

class MasterSearch extends Master
{
    public $username;
    public $name;
    public $surname;
    public $middlename;
    public $city;
    public $psys;
    public $pros;
    public $psy_id;
    public $pro_id;
    public $fio;

    public function rules()
    {
        return [
          [['psys','pros','fio'],'safe'],
          [['psy_id','pro_id'],'integer'],
        ];
    }
    public function search ($params=[])
    {
        $query = Master::find();
//        $query->joinWith(['pros','psys']);
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
        ]);
        $dataProvider->setSort([
            'attributes'=>[
                'id',
                'name',
                'fio'=>[
                    'asc'=>['name'=>SORT_ASC,'surname'=>SORT_ASC],
                    'desc'=>['name'=>SORT_DESC,'surname'=>SORT_DESC],
                    'label'=>'Ф.И.О.',
                    'default'=>SORT_ASC
                ]
            ]
        ]);


//        $dataProvider->sort->attributes['pros'] = [
//            'asc' => ['profession_item'=> SORT_ASC],
//            'desc' => ['profession_item'=> SORT_DESC],
//        ];
//        $dataProvider->sort->attributes['psys'] = [
//            'asc' => ['psychotherapy_item'=> SORT_ASC],
//            'desc' => ['psychotherapy_item'=> SORT_DESC],
//        ];
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $this->addCondition($query,'id');
        $this->addCondition($query,'name',true);
        $this->addCondition($query,'surname',true);

        if ($this->pro_id){
            $query->byPros($this->pro_id);
        }

        $query->andWhere('name LIKE "%'.$this['name'].'%" '.'OR surname LIKE "%'.$this['surname'].'%"');

//        $query
//            ->andFilterWhere(['like','profession_item.name',$this->pros])
//            ->andFilterWhere(['like','psychotherapy_item.name',$this->psys]);

        return $dataProvider;
    }
}
