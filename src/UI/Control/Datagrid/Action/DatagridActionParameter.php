<?php

declare(strict_types = 1);

namespace App\UI\Control\Datagrid\Action;

class DatagridActionParameter
{

	public function __construct(private string $parameter, private string $referencedColumn)
	{
	}

	public function getParameter(): string
	{
		return $this->parameter;
	}

	public function getReferencedColumn(): string
	{
		return $this->referencedColumn;
	}

}
