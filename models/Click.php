<?php

namespace app\models;


class Click
{
	private $id;

	private $ua;

	private $ip;

	private $ref;

	private $param1;

	private $param2;

	private $error;

	private $bad_domain;

	public static function fromState($state) : Click
	{
		return new self(
			$state['id'],
			$state['ua'],
			$state['ip'],
			$state['ref'],
			$state['param1'],
			$state['param2'],
			$state['error'],
			$state['bad_domain']
		);
	}

	public function __construct($id = 0, $ua = '', $ip = 0, $ref = '', $param1 = '', $param2 = '', $error = 0, $bad_domain = 0)
	{
		if (empty($id)) {
			$this->id = md5(
				$ua . ',' . $ip . ',' . $ref . ',' . $param1 . ',' . uniqid()
			);
		} else {
			$this->id = $id;
		}
		$this->ua = $ua;
		$this->ip = $ip;
		$this->ref = $ref;
		$this->param1 = $param1;
		$this->param2 = $param2;
		$this->error = $error;
		$this->bad_domain = $bad_domain;
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

}