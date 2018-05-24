<?php
namespace app\services;

use app\models\Click;
use app\models\ClickValidation;
use app\repositories\interfaces\iBadDomainsRepository;
use app\repositories\interfaces\iClickRepository;
use app\services\builder\ClickBuilderRequest;
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

		$click = (new ClickBuilderRequest($request))->addParams()->build();

		/** @var Click $existClick */
		$existClick = $this->clickRepository->findUnique($click);

		if (!$validator->validateBadDomain($this->badDomainsRepository)) {
			$click->incrementError()->setBadDomain();
		}

		if ($existClick != null) {
			$click->incrementError();
			$existClick->incrementError();
			$this->clickRepository->update($existClick);
		} else {
			$this->clickRepository->create($click);
		}

		return $click;
	}

	public function getError()
	{
		return $this->error;
	}
}