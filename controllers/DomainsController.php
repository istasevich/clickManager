<?php

namespace app\controllers;

use app\repositories\BadDomainRepository;
use app\services\BadDomainCreate;
use app\services\DomainRequest;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use app\repositories\interfaces\iBadDomainsRepository;

class DomainsController  extends Controller
{

	/** @var  iBadDomainsRepository */
	protected $badDomainRepository;

	/** @var  BadDomainCreate*/
	protected $badDomainServiceCreate;

	public function init()
	{
		$dbConnection = \Yii::$app->getDb();

		/**
		 * Here I do not use the Yii container, because Yii uses it through the Service Locator :)
		 */

		$this->badDomainRepository = new BadDomainRepository($dbConnection);
		$this->badDomainServiceCreate = new BadDomainCreate($this->badDomainRepository);

		parent::init();
	}

	public function actionIndex()
	{

		if (\Yii::$app->request->isPost && \Yii::$app->request->post('domain') != '') {
			$this->_create(\Yii::$app->request->post('domain'));
		}

		$result = $this->badDomainRepository->find([], true);

		$provider = new ArrayDataProvider([
			'allModels' => $result,
			'pagination' => [
				'pageSize' => 20,
			],
		]);

		return $this->render('index', ['domains' => $provider]);
	}

	protected function _create($name)
	{
		$request = new DomainRequest([
			'referral' => $name
		]);

		try {
			$this->badDomainServiceCreate->execute($request);
		} catch (\Exception $e) {
			throw new \Exception('Cant save bad_domain');
		}
	}
}