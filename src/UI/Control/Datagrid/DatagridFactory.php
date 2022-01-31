<?php

declare(strict_types = 1);

namespace App\UI\Control\Datagrid;

use App\UI\Control\Datagrid\Datasource\IDataSource;
use Nette\Http\Session;

class DatagridFactory
{

	public function __construct(private Session $session)
	{
	}

	public function create(IDataSource $dataSource): Datagrid
	{
		return new Datagrid($dataSource, $this->session);
	}

}
