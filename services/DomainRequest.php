<?php

namespace app\services;


use app\services\interfaces\iRequest;

class DomainRequest implements iRequest
{
	protected $userAgent;
	protected $ip;
	protected $referral;
	protected $param1;
	protected $param2;

	public function __construct($data = [])
	{
		$this->referral = $data['referral'] ?? null;
		$this->ip = $data['ip'] ?? null;
		$this->userAgent = $data['userAgent'] ?? null;
		$this->param1 = $data['param1'] ?? null;
		$this->param2 = $data['param2'] ?? null;
	}

	public function getUserAgent()
	{
		return $this->userAgent;
	}

	public function getIp()
	{
		return $this->ip;
	}

	public function getReferral()
	{
		return $this->referral;
	}

	public function getParam1()
	{
		return $this->param1;
	}

	public function getParam2()
	{
		return $this->getParam2();
	}

	public function getRequiredParams()
	{
		return [];
	}

}