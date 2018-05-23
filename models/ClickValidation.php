<?php

namespace app\models;

use app\repositories\interfaces\iBadDomainsRepository;
use app\services\interfaces\iRequest;
use yii\base\Exception;


class ClickValidation
{
	protected $request;

	public function __construct(iRequest $request)
	{
		$this->request = $request;
	}

	public function validateRequiredParams()
	{
		foreach ($this->request->getRequiredParams() as $k => $value) {
			if ($value == null) {
				throw new Exception('Parameter ' . $k . ' is invalid or empty');
			}
		}
	}

	public function validateBadDomain(iBadDomainsRepository $iBadDomainsRepository)
	{
		$referrer = $this->request->getReferral();

		if (empty($referrer)) {
			return true;
		}

		$domain = $iBadDomainsRepository->findOne($referrer);

		if (!empty($domain)) {
			return false;
		}

		return true;
	}
}