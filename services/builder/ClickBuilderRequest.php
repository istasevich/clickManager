<?php
namespace app\services\builder;

use app\models\Click;
use app\services\interfaces\iRequest;

class ClickBuilderRequest extends AbstractClickBuilder
{
	private $request;

	public function __construct(iRequest $request)
	{
		$this->request = $request;
	}

	public function addParams()
	{
		$this->useAgent = $this->request->getUserAgent();
		$this->ref = $this->request->getReferral();
		$this->ip = $this->request->getIp();
		$this->error = 0;
		$this->badDomain = 0;
		$this->param1 = $this->request->getParam1();
		$this->param2 = $this->request->getParam2();

		return $this;
	}

	public function build() : Click
	{
		return new Click($this);
	}
}