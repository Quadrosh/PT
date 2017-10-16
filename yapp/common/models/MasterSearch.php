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

    public function rules()
    {
        return [
          [['psys','pros'],'safe'],
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
        if ($this->pro_id){
            $query->byPros($this->pro_id);
        }


//        $query
//            ->andFilterWhere(['like','profession_item.name',$this->pros])
//            ->andFilterWhere(['like','psychotherapy_item.name',$this->psys]);

        return $dataProvider;
    }
}
