<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ArticleSectionBlock;

/**
 * ArticleSectionBlockSearch represents the model behind the search form about `common\models\ArticleSectionBlock`.
 */
class ArticleSectionBlockSearch extends ArticleSectionBlock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'article_section_id', 'accent', 'created_at', 'updated_at'], 'integer'],
            [['header', 'header_class', 'description', 'raw_text', 'image', 'image_alt', 'background_image', 'thumbnail_image', 'call2action_description', 'call2action_name', 'call2action_link', 'call2action_class', 'call2action_comment', 'view', 'color_key', 'structure', 'custom_class'], 'safe'],
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
        $query = ArticleSectionBlock::find();

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
            'article_section_id' => $this->article_section_id,
            'accent' => $this->accent,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'header', $this->header])
            ->andFilterWhere(['like', 'header_class', $this->header_class])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'raw_text', $this->raw_text])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'image_alt', $this->image_alt])
            ->andFilterWhere(['like', 'background_image', $this->background_image])
            ->andFilterWhere(['like', 'thumbnail_image', $this->thumbnail_image])
            ->andFilterWhere(['like', 'call2action_description', $this->call2action_description])
            ->andFilterWhere(['like', 'call2action_name', $this->call2action_name])
            ->andFilterWhere(['like', 'call2action_link', $this->call2action_link])
            ->andFilterWhere(['like', 'call2action_class', $this->call2action_class])
            ->andFilterWhere(['like', 'call2action_comment', $this->call2action_comment])
            ->andFilterWhere(['like', 'view', $this->view])
            ->andFilterWhere(['like', 'color_key', $this->color_key])
            ->andFilterWhere(['like', 'structure', $this->structure])
            ->andFilterWhere(['like', 'custom_class', $this->custom_class]);

        return $dataProvider;
    }
}
