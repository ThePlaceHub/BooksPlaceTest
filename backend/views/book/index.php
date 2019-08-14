<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'authorFirstName',
                'label' => 'Author\'s First Name',
                'value' => 'author.first_name'
            ],

            [
                'attribute' => 'authorLastName',
                'label' => 'Author\'s Last Name',
                'value' => 'author.last_name'
            ],

            'title',

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
