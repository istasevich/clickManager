<?php

namespace app\repositories\interfaces;

use app\models\Click;

interface iClickRepository extends iRepository
{
	public function create(Click $click);
	public function update(Click $click);
	public function findOne($id);
	public function find($filters = [], $isArray = false);
	public function findUnique(Click $click);
}