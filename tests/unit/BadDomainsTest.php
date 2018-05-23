<?php

use app\models\BadDomain;
use app\repositories\BadDomainRepository;
use app\services\BadDomainCreate;
use app\services\DomainRequest;

class BadDomainsTest extends \Codeception\Test\Unit
{
	/**
	 * @var \UnitTester
	 */
	protected $tester;


	protected function _before()
	{
	}

	protected function _after()
	{
	}

	public function testCreateBadDomain()
	{
		$badDomainsRepository = new BadDomainRepository(
			new yii\db\Connection(['dsn' => 'mysql:host=127.0.0.1;dbname=clickManager', 'username' => 'root', 'password' => ''])
		);
		$domain = new BadDomain('http://testFromUnit.com');

		$domain = $badDomainsRepository->create($domain);
		$this->assertTrue($domain instanceof BadDomain);
	}

	public function testBadDomainService()
	{
		$clickRepository = $this->getMockBuilder('app\repositories\BadDomainRepository')
			->setConstructorArgs([new yii\db\Connection(['dsn' => '', 'username' => '', 'password' => ''])])
			->setMethods(['create', 'findOne', 'find'])
			->getMock();

		$domain = new BadDomain('test.com');

		$clickRepository->method('create')->willReturn($domain);
		$clickRepository->method('findOne')->willReturn($domain);


		$badDomainsRepo = $this->getMockBuilder('app\repositories\BadDomainRepository')
			->setConstructorArgs([new yii\db\Connection(['dsn' => '', 'username' => '', 'password' => ''])])
			->setMethods(['create', 'findOne', 'find'])
			->getMock();

		$clickService = new BadDomainCreate($clickRepository, $badDomainsRepo);

		$request = new DomainRequest(['referral' => 'test.com']);

		$click = $clickService->execute($request);

		$this->assertTrue($click instanceof BadDomain);

	}
}