<?php


namespace tests\models;

class Click extends \Codeception\Test\Unit
{
	private $model;

	public function testCreateClick()
	{
		expect_not(User::findIdentity(999));
	}
}