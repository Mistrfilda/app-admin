<?php

declare(strict_types = 1);

namespace App\Admin\UI;

use App\UI\Base\BaseAdminPresenter;

class AppAdminPresenter extends BaseAdminPresenter
{

	public function renderDefault(): void
	{
		$this->template->heading = 'Uživatelé';
	}

}
