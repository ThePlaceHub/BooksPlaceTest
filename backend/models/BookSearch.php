<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Book;

/**
 * BookSearch represents the model behind the search form of `backend\models\Book`.
 */
class BookSearch extends Book
{
    public $authorFirstName;
    public $authorLastName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'authorFirstName', 'authorLastName', 'updated', 'created'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Book::find();
        $query->joinWith(['author']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['authorFirstName'] = [
            'asc' => [Author::tableName().'.first_name' => SORT_ASC],
            'desc' => [Author::tableName().'.first_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['authorLastName'] = [
            'asc' => [Author::tableName().'.last_name' => SORT_ASC],
            'desc' => [Author::tableName().'.last_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', Author::tableName().'.first_name', $this->authorFirstName])
            ->andFilterWhere(['like', Author::tableName().'.first_name', $this->authorLastName])
            ->andFilterWhere(['like', 'title', $this->title]);

        if ($this->updated)
            $query->andFilterWhere(['between', 'book.updated', strtotime($this->updated), strtotime($this->updated) + 86400]);

        if ($this->created)
            $query->andFilterWhere(['between', 'book.created', strtotime($this->created), strtotime($this->created) + 86400]);

        return $dataProvider;
    }
}
