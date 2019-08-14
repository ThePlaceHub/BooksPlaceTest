<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $updated
 * @property int $created
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated', 'created'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'updated' => 'Updated',
            'created' => 'Created',
        ];
    }

    public function getBooksCount()
    {
        if ($this->isNewRecord) {
            return null;
        }

        return $this->booksAggregation[0]['counted'] ?? 0;
    }

    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['author_id' => 'id']);
    }

    public function getBooksAggregation()
    {
        return $this->getBooks()
            ->select(['author_id', 'counted' => 'count(*)'])
            ->groupBy('author_id')
            ->asArray(true);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated'],
                ],
            ],
        ];
    }

    public static function getList()
    {
        $list = self::find()->select(['id', 'concat(first_name, " ", last_name) as name'])->asArray()->all();

        return ArrayHelper::map($list, 'id', 'name');
    }
}
