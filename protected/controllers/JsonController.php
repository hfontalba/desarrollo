<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    // ...código existente...

    public function actionSay($message = 'Hola')
    {
        return $this->render('say', ['message' => $message]);
    }
}