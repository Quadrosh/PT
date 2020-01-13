<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ArticleSectionBlockItem;

/**
 * ArticleSectionBlockItemSearch represents the model behind the search form about `common\models\ArticleSectionBlockItem`.
 */
class ArticleSectionBlockItemSearch extends ArticleSectionBlockItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'article_section_block_id', 'sort', 'accent', 'created_at', 'updated_at'], 'integer'],
            [['header', 'header_class', 'description', 'text', 'comment', 'image', 'image_alt', 'link_description', 'link_name', 'link_url', 'link_class', 'link_comment', 'view', 'color_key', 'structure', 'custom_class', 'type'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ArticleSectionBlockItem::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'article_section_block_id' => $this->article_section_block_id,
            'sort' => $this->sort,
            'accent' => $this->accent,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'header', $this->header])
            ->andFilterWhere(['like', 'header_class', $this->header_class])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'image_alt', $this->image_alt])
            ->andFilterWhere(['like', 'link_description', $this->link_description])
            ->andFilterWhere(['like', 'link_name', $this->link_name])
            ->andFilterWhere(['like', 'link_url', $this->link_url])
            ->andFilterWhere(['like', 'link_class', $this->link_class])
            ->andFilterWhere(['like', 'link_comment', $this->link_comment])
            ->andFilterWhere(['like', 'view', $this->view])
            ->andFilterWhere(['like', 'color_key', $this->color_key])
            ->andFilterWhere(['like', 'structure', $this->structure])
            ->andFilterWhere(['like', 'custom_class', $this->custom_class])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
