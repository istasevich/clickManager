<?php

namespace app\models;


class BadDomain
{
	private $id;

	private $name;

	public static function fromState($state) : BadDomain
	{
		return new self(
			$state['name'],
			$state['id']
		);
	}

	public function __construct($name, $id = 0)
	{
		$this->id = $id;
		$this->name = $name;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

}