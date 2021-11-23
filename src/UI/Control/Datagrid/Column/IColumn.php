<?php

declare(strict_types = 1);

namespace App\UI\Control\Datagrid\Column;

use App\UI\Control\Datagrid\FrontDatagrid;
use Mistrfilda\Datetime\Types\ImmutableDateTime;
use Ramsey\Uuid\UuidInterface;

interface IColumn
{

	public function getDatagrid(): FrontDatagrid;

	public function getLabel(): string;

	public function getColumn(): string;

	public function getTemplate(): string;

	public function getGetterMethod(): callable|null;

	public function processValue(string|int|float|ImmutableDateTime|UuidInterface $value): string;

}
