<?php

declare(strict_types = 1);

namespace App\Admin\UI;

use App\UI\Base\BaseAdminPresenter;
use App\UI\Control\Datagrid\Datagrid;

class AppAdminPresenter extends BaseAdminPresenter
{

	public function __construct(
		private AppAdminGridFactory $appAdminGridFactory,
	)
	{
		parent::__construct();
	}

	public function renderDefault(): void
	{
		$this->template->heading = 'Uživatelé';
	}

	protected function createComponentAppAdminGrid(): Datagrid
	{
		return $this->appAdminGridFactory->create();
	}

}
