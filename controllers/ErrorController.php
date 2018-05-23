<?php

namespace app\controllers;

use app\models\Click;
use app\repositories\ClickRepository;
use app\repositories\interfaces\iClickRepository;
use yii\web\Controller;

class ErrorController extends Controller
{

	/** @var  iClickRepository */
	protected $clickRepository;

	public function init()
	{
		$this->clickRepository = new ClickRepository(\Yii::$app->getDb());
		parent::init();
	}

	public function actionIndex($id)
	{
		/** @var Click $click */
		$click = $this->clickRepository->findOne($id);

		if ($click && $click->getBadDomain() == 1) {
			$error = 'The broken domain';
		} else {
			$error = 'Unique click detected';
		}

		\Yii::$app->getSession()->setFlash('error', $error);

		return $this->render('index');
	}
}