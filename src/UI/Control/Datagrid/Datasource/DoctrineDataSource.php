<?php

declare(strict_types = 1);

namespace App\UI\Control\Datagrid\Datasource;

use App\Doctrine\IEntity;
use App\UI\Control\Datagrid\Column\IColumn;
use Doctrine\ORM\QueryBuilder;
use Nette\Utils\Strings;
use Ramsey\Uuid\UuidInterface;

class DoctrineDataSource implements IDataSource
{

	public function __construct(private QueryBuilder $qb)
	{
	}

	/** @return array<string|int, IEntity> */
	public function getData(int $offset, int $limit): array
	{
		/** @var array<string|int, IEntity> $results */
		$results = $this->qb
			->setFirstResult($offset)
			->setMaxResults($limit)
			->getQuery()
			->getResult();

		return $results;
	}

	public function getCount(): int
	{
		$countQb = clone $this->qb;

		$result = $countQb
			->select('count(:rootAlias)')
			->setParameter('rootAlias', sprintf('%s.*', $this->getRootAlias()))
			->getQuery()
			->getSingleScalarResult();

		assert(is_string($result));

		return (int) $result;
	}

	public function getValueForColumn(IColumn $column, IEntity $row): string
	{
		if ($column->getGetterMethod() !== null) {
			return $column->getGetterMethod()($row);
		}

		$getterMethod = 'get' . Strings::firstUpper($column->getColumn());
		if (method_exists($row, $getterMethod) === false) {
			throw new DoctrineDataSourceException(
				sprintf(
					'Missing getter %s in entity %s',
					$getterMethod,
					$row::class,
				),
			);
		}

		//@phpstan-ignore-next-line
		return $column->processValue($row->{$getterMethod}());
	}

	public function getValueForKey(string $key, IEntity $row): string|int|float|UuidInterface
	{
		$getterMethod = 'get' . Strings::firstUpper($key);
		if (method_exists($row, $getterMethod) === false) {
			throw new DoctrineDataSourceException(
				sprintf(
					'Missing getter %s in entity %s',
					$getterMethod,
					$row::class,
				),
			);
		}

		//@phpstan-ignore-next-line
		return $row->{$getterMethod}();
	}

	private function getRootAlias(): string
	{
		$rootAliases = $this->qb->getRootAliases();
		if (array_key_exists(0, $rootAliases)) {
			return $rootAliases[0];
		}

		throw new DoctrineDataSourceException('Root alias not found');
	}

}
