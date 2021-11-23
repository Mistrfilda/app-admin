<?php

declare(strict_types = 1);

namespace App\UI\Control\Datagrid\Filter;

use App\UI\Control\Datagrid\Column\ColumnText;

class FilterText implements IFilter
{

	public const TYPE = 'FILTER_TEXT';

	private string|null $value;

	public function __construct(private ColumnText $column)
	{
	}

	public function setValue(string $value): void
	{
		$this->value = $value;
	}

	public function getType(): string
	{
		return self::TYPE;
	}

	public function getColumn(): ColumnText
	{
		return $this->column;
	}

	public function getValue(): mixed
	{
		return $this->value;
	}

}
