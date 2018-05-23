<?php

namespace app\services\interfaces;


interface iRequest
{
	public function getUserAgent();
	public function getRequiredParams();
	public function getIp();
	public function getReferral();
	public function getParam1();
	public function getParam2();
}