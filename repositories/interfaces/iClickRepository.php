<?php

namespace app\repositories\interfaces;

use app\models\Click;

interface iClickRepository extends iRepository
{
	public function create(Click $click);
	public function findOne($id);
	public function incrementError(Click $click);
	public function find($filters = [], $isArray = false);
	public function setBadDomain(Click $click);
	public function findUnique(Click $click);
}