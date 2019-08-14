<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuthorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Author', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'first_name',
            'last_name',

            [
                'attribute' => 'booksCount',
                'label' => 'Books Count',
                'value' => function ($searchModel) {
                    return $searchModel->getBooksCount();
                }
            ],

            [
                'attribute' => 'updated',
                'label' => 'Updated',
                'value' => 'updated',
                'format' => ['date', 'php:Y-m-d H:i:s'],
                'filter' => \yii\jui\DatePicker::widget([
                    'model'=> $searchModel,
                    'attribute'=>'updated',
                    'language' => 'ru',
                    'dateFormat' => 'dd-MM-yyyy',
                ]),
            ],

            [
                'attribute' => 'created',
                'label' => 'Created',
                'value' => 'created',
                'format' => ['date', 'php:Y-m-d H:i:s'],
                'filter' => \yii\jui\DatePicker::widget([
                    'model'=> $searchModel,
                    'attribute'=>'created',
                    'language' => 'ru',
                    'dateFormat' => 'dd-MM-yyyy',
                ]),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
