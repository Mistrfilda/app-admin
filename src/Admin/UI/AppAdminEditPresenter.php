<?php

declare(strict_types = 1);

namespace App\Admin\UI;

use App\UI\Base\BaseAdminPresenter;

class AppAdminEditPresenter extends BaseAdminPresenter
{

	public function renderDefault(string|null $id): void
	{
		$this->template->heading = $id === null ? 'Vytvoření nového uživatele' : 'Editace uživatele';
	}

}
