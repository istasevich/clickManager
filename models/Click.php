<?php

namespace app\models;


use app\services\builder\AbstractClickBuilder;

class Click
{
	private $id;

	private $ua;

	private $ip;

	private $ref;

	private $param1;

	private $param2;

	private $error = 0;

	private $bad_domain;


	public function __construct(AbstractClickBuilder $builder)
	{
		if (empty($builder->id)) {
			$this->id = md5(
				$builder->useAgent . ',' . $builder->ip . ',' . $builder->ref . ',' . $builder->ref . ',' . uniqid()
			);
		} else {
			$this->id = $builder->id;
		}

		$this->ua = $builder->useAgent;
		$this->ip = $builder->ip;
		$this->ref = $builder->ref;
		$this->param1 = $builder->param1;
		$this->param2 = $builder->param2;
		$this->error = $builder->error;
		$this->bad_domain = $builder->badDomain;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getUserAgent()
	{
		return $this->ua;
	}

	public function getIp()
	{
		return $this->ip;
	}

	public function getReferral()
	{
		return $this->ref;
	}

	public function getParam1()
	{
		return $this->param1;
	}

	public function getParam2()
	{
		return $this->param2;
	}

	public function getError()
	{
		return (int)$this->error;
	}


	public function getBadDomain()
	{
		return $this->bad_domain;
	}

	public function incrementError()
	{
		$this->error++;
		return $this;
	}

	public function setBadDomain()
	{
		$this->bad_domain = 1;
		return $this;
	}

}