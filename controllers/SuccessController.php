<?php

namespace app\controllers;

use yii\web\Controller;

class SuccessController extends Controller
{
	public function actionIndex($id)
	{
		\Yii::$app->getSession()->setFlash('success', 'Click was successfully added');

		return $this->render('index');
	}
}