<?php

namespace app\repositories\interfaces;

use app\models\BadDomain;

interface iBadDomainsRepository extends iRepository
{
	public function create(BadDomain $badDomain);
	public function findOne($domainName);
	public function find($filters = [], $isArray = false);
}