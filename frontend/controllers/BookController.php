<?php

namespace frontend\controllers;

use backend\models\Book;

class BookController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $books = Book::find()->joinWith(['author'])->all();

        return $this->render('index', [
            'books' => $books
        ]);
    }

}
