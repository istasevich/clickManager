<?php

namespace app\services;

use app\repositories\interfaces\iBadDomainsRepository;
use app\services\interfaces\iRequest;
use app\services\interfaces\iServices;

class BadDomainCreate implements iServices
{
	/** @var  iBadDomainsRepository */
	private $badDomainsRepository;


	public function __construct(iBadDomainsRepository $badDomainsRepository)
	{
		$this->badDomainsRepository = $badDomainsRepository;
	}

	public function execute(iRequest $request)
	{
		$domainName = $request->getReferral();
		$domain = $this->badDomainsRepository->findOne($request->getReferral());

		if ($domain != null) {
			return $domain;
		}

		$newBadDomain = new \app\models\BadDomain($domainName);
		$domain = $this->badDomainsRepository->create($newBadDomain);


		return $domain;
	}
}