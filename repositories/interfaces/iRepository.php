<?php

namespace app\repositories\interfaces;


interface iRepository
{
	public function findOne($id);
	public function find($filters = []);
}