<?php

namespace app\services\builder;


use app\models\Click;

class ClickBuilder extends AbstractClickBuilder
{
	private $data;

	public function __construct($data = [])
	{
		$this->data = $data;
	}

	public function addParams()
	{
		$this->id = $this->data['id'] ?? null;
		$this->ref = $this->data['ref'] ?? null;
		$this->ip = $this->data['ip'] ?? null;
		$this->useAgent = $this->data['ua'] ?? null;
		$this->param1 = $this->data['param1'] ?? null;
		$this->param2 = $this->data['param2'] ?? null;
		$this->error = $this->data['error'] ?? 0 ;
		$this->badDomain = $this->data['bad_domain'] ?? 0;

		return $this;
	}

	public function build(): Click
	{
		return new Click($this);
	}
}