<?php

declare(strict_types = 1);

namespace App\UI\Base;

use App\Admin\CurrentAppAdminGetter;
use App\UI\Menu\MenuBuilder;

abstract class BaseAdminPresenter extends BasePresenter
{

	protected CurrentAppAdminGetter $currentAppAdminGetter;

	public function injectCurrentAppAdminGetter(CurrentAppAdminGetter $currentAppAdminGetter): void
	{
		$this->currentAppAdminGetter = $currentAppAdminGetter;
	}

	public function startup(): void
	{
		parent::startup();
		if ($this->currentAppAdminGetter->isLoggedIn() === false) {
			$this->redirect('Login:default', ['backlink' => $this->storeRequest()]);
		}

		$this->template->appAdmin = $this->currentAppAdminGetter->getAppAdmin();
		$this->template->menuItems = (new MenuBuilder())->buildMenu();
		$this->template->includeBody = true;
	}

	public function handleLogout(): void
	{
		$this->currentAppAdminGetter->logout();
		$this->redirect('this');
	}

}
