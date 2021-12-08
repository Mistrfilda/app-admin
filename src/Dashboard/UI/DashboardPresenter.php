<?php

declare(strict_types = 1);

namespace App\Dashboard\UI;

use App\UI\Base\BaseAdminPresenter;

class DashboardPresenter extends BaseAdminPresenter
{

	public function renderDefault(): void
	{
		$this->template->heading = 'Dashboard';
	}

}
