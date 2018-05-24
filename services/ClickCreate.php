<?php
namespace app\services;

use app\models\Click;
use app\models\ClickValidation;
use app\repositories\interfaces\iBadDomainsRepository;
use app\repositories\interfaces\iClickRepository;
use app\services\interfaces\iRequest;
use app\services\interfaces\iServices;

class ClickCreate implements iServices
{
	const ERROR_UNIQUE = 0;
	const ERROR_BAD_DOMAIN = 1;

	/** @var  iClickRepository */
	private $clickRepository;

	/** @var  iBadDomainsRepository */
	private $badDomainsRepository;

	private $error = null;

	public function __construct(iClickRepository $clickRepository, iBadDomainsRepository $badDomainsRepository)
	{
		$this->clickRepository = $clickRepository;
		$this->badDomainsRepository = $badDomainsRepository;
	}

	/**
	 * @param iRequest $request
	 * @return mixed
	 * @throws \Exception
	 */
	public function execute(iRequest $request)
	{
		$validator = new ClickValidation($request);

		try {
			$validator->validateRequiredParams();
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}

		$click = new Click(
			0,
			$request->getUserAgent(),
			$request->getIp(),
			$request->getReferral(),
			$request->getParam1(),
			$request->getParam2()
		);

		$existClick = $this->clickRepository->findUnique($click);

		if (!$validator->validateBadDomain($this->badDomainsRepository)) {
			$click->incrementError();
			$click->setBadDomain();
		}

		if ($existClick != null) {
			$click->incrementError();
		} else {
			$this->clickRepository->create($click);
		}

		return $click;

		//return $this->clickRepository->findOne($click->getId());
	}

	public function getError()
	{
		return $this->error;
	}
}