<?php

use app\models\Click;
use app\repositories\ClickRepository;
use app\repositories\interfaces\iClickRepository;
use app\services\ClickCreate;
use app\services\ClickRequest;
use PHPUnit\Framework\ExpectationFailedException;

class ClickTest extends \Codeception\Test\Unit
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

    public function testClickCreateRepository()
    {
		$clickRepository = new ClickRepository(
			new yii\db\Connection(['dsn' => 'mysql:host=127.0.0.1;dbname=clickManager', 'username' => 'root', 'password' => ''])
		);
	    $click = new Click(
	    	0,
		    'Some user agent for test',
		    '127.0.0.1',
		    'teg',
		    'param1'
	    );

		$click = $clickRepository->create($click);
		$this->assertTrue($click instanceof Click);

    }

    public function testClickCreate()
    {
		$click = new Click(0, 'Some user agent for test 2',
			'127.0.0.1',
			'teg',
			'param1');

	    $this->assertTrue($click instanceof Click);
    }

    public function testClickServiceFailUserAgent()
    {
    	$clickRepository = $this->getMockBuilder('app\repositories\ClickRepository')
		    ->setConstructorArgs([new yii\db\Connection(['dsn' => '', 'username' => '', 'password' => ''])])
		    ->setMethods(['create', 'findOne', 'find'])
		    ->getMock();


	    $badDomainsRepo = $this->getMockBuilder('app\repositories\BadDomainRepository')
		    ->setConstructorArgs([new yii\db\Connection(['dsn' => '', 'username' => '', 'password' => ''])])
		    ->setMethods(['create', 'findOne', 'find'])
		    ->getMock();

    	$clickService = new ClickCreate($clickRepository, $badDomainsRepo);

    	$request = new ClickRequest([]);
    	try {
		    $clickService->execute($request);
	    } catch (\Exception $e) {
			$this->assertEquals('Parameter userAgent is invalid or empty', $e->getMessage());
	    }
    }

	public function testClickService()
	{
		$clickRepository = $this->getMockBuilder('app\repositories\ClickRepository')
			->setConstructorArgs([new yii\db\Connection(['dsn' => '', 'username' => '', 'password' => ''])])
			->setMethods(['create', 'findOne', 'find'])
			->getMock();

		$click = new Click();

		$clickRepository->method('create')->willReturn($click);
		$clickRepository->method('findOne')->willReturn($click);


		$badDomainsRepo = $this->getMockBuilder('app\repositories\BadDomainRepository')
			->setConstructorArgs([new yii\db\Connection(['dsn' => '', 'username' => '', 'password' => ''])])
			->setMethods(['create', 'findOne', 'find'])
			->getMock();

		$clickService = new ClickCreate($clickRepository, $badDomainsRepo);

		$request = new ClickRequest(['userAgent' => 'test unit', 'referral' => 'test.com', 'ip' => '0.0.0.0', 'param1' => 'test']);

		$click = $clickService->execute($request);

		$this->assertTrue($click instanceof Click);

	}


}