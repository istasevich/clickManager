<?php

namespace app\repositories;


use app\models\BadDomain;
use app\repositories\interfaces\iBadDomainsRepository;
use yii\db\Query;

class BadDomainRepository implements iBadDomainsRepository
{
	private $dbConnection;

	/**
	 * BadDomainRepository constructor.
	 *
	 * @param \yii\db\Connection $connection
	 */
	public function __construct(\yii\db\Connection $connection)
	{
		$this->dbConnection = $connection;
	}

	/**
	 * @param BadDomain $badDomain
	 * @return BadDomain
	 */
	public function create(BadDomain $badDomain)
	{
		$this->dbConnection->createCommand()->insert('bad_domains', [
			'name' => $badDomain->getName(),
		])->execute();

		$id = $this->dbConnection->getLastInsertID();

		return BadDomain::fromState([
			'name' => $badDomain->getName(),
			'id' => $id
		]);
	}


	/**
	 * @param array $filters
	 * @param bool $isArray
	 * @return array|null
	 */
	public function find($filters = [], $isArray = false)
	{
		$domains = new Query();
		$domains->from('bad_domains');
		$domains->select(['id', 'name']);
		$domains->where($filters);

		$result = $domains->all();

		if (empty($result)) {
			return null;
		}

		if ($isArray === false) {
			return array_map(function ($item) {
				return BadDomain::fromState($item);
			}, $result);
		}

		return $result;
	}

	/**
	 * @param $badDomainName
	 * @return BadDomain|null
	 */
	public function findOne($badDomainName)
	{
		$command = $this->dbConnection->createCommand('SELECT id, name FROM bad_domains WHERE name=:name');
		$command->bindValue(':name', $badDomainName);
		$badDomain = $command->queryOne();

		if (empty($badDomain)) {
			return null;
		}

		return BadDomain::fromState($badDomain);
	}
}