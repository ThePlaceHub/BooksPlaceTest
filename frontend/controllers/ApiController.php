<?php

namespace frontend\controllers;

use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public $modelClass = 'frontend\models\Book';

}

