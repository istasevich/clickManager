<?php

namespace app\services\builder;

use app\models\Click;

abstract class AbstractClickBuilder
{
	public $id;
	public $useAgent;
	public $ref;
	public $ip;
	public $param1;
	public $param2;
	public $error;
	public $badDomain;

	public function __construct()
	{
	}

	abstract function addParams();
	abstract function build() : Click;
}