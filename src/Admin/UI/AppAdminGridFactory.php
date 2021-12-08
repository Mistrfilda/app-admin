<?php

declare(strict_types = 1);

namespace App\Admin\UI;

use App\Admin\AppAdminRepository;
use App\UI\Control\Datagrid\Datagrid;
use App\UI\Control\Datagrid\DatagridFactory;
use App\UI\Control\Datagrid\Datasource\DoctrineDataSource;
use App\UI\Tailwind\TailwindColorConstant;

class AppAdminGridFactory
{

	public function __construct(
		private DatagridFactory $datagridFactory,
		private AppAdminRepository $appAdminRepository,
	)
	{
	}

	public function create(): Datagrid
	{
		$grid = $this->datagridFactory->create(
			new DoctrineDataSource(
				$this->appAdminRepository->createQueryBuilder(),
			),
		);

		$grid->addColumnText('name', 'Jméno');
		$grid->addColumnText('username', 'Uživatelské jméno');
		$grid->addColumnBadge('email', 'Email', TailwindColorConstant::BLUE);
		$grid->addColumnDatetime('createdAt', 'Vytvořen');
		$grid->addColumnDatetime('createdAt', 'Poslední aktualizace');

		$grid->setMaxResultSet(2);

		return $grid;
	}

}
