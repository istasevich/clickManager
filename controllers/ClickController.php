<?php

namespace app\controllers;

use app\repositories\BadDomainRepository;
use app\repositories\ClickRepository;
use app\repositories\interfaces\iBadDomainsRepository;
use app\repositories\interfaces\iClickRepository;
use app\services\ClickCreate;
use app\services\ClickRequest;
use yii\web\Controller;

class ClickController extends Controller
{
	protected $container;

	/** @var  iClickRepository */
	protected $clickRepository;

	/** @var  iBadDomainsRepository */
	protected $badDomainRepository;

	/** @var  ClickRequest */
	protected $clickRequest;


	public function init()
	{
		parent::init();
		$dbConnection = \Yii::$app->getDb();
		$this->clickRepository = new ClickRepository($dbConnection);
		$this->badDomainRepository = new BadDomainRepository($dbConnection);
		$this->clickRequest = $this->initRequest();
	}

	public function actionIndex()
	{
		$serviceCreateClick = new ClickCreate($this->clickRepository, $this->badDomainRepository);

		try {
			$click = $serviceCreateClick->execute($this->clickRequest);
		} catch(\Exception $e) {
			return $this->redirect('/');
		}

		if (!empty($click->getError())) {
			return $this->redirect(['error/' . $click->getId()]);
		}

		return $this->redirect(['success/' . $click->getId()]);

	}

	public function actionList()
	{
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $this->clickRepository->find([], true);
	}


	protected function initRequest()
	{
		$yiiRequest = \Yii::$app->request;

		return new ClickRequest([
			'userAgent' => $yiiRequest->getUserAgent(),
			'ip' => $yiiRequest->getUserIP(),
			'referral' => $yiiRequest->getReferrer(),
			'param1' => $yiiRequest->get('param1'),
			'param2' => $yiiRequest->get('param2')
		]);
	}
}