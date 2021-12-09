<?php

declare(strict_types = 1);

namespace App\Admin\UI;

use App\UI\Base\BaseAdminPresenter;
use App\UI\Control\Form\AdminForm;
use App\UI\FlashMessage\FlashMessageType;

class AppAdminEditPresenter extends BaseAdminPresenter
{

	public function __construct(
		private AppAdminFormFactory $appAdminFormFactory,
	)
	{
		parent::__construct();
	}

	public function renderDefault(string|null $id): void
	{
		$this->template->heading = $id === null ? 'Vytvoření nového uživatele' : 'Editace uživatele';
	}

	protected function createComponentAppAdminFormFactory(): AdminForm
	{
		$id = $this->processParameterUuid();

		$onSuccess = function () use ($id): void {
			if ($id !== null) {
				$this->flashMessage('Uživatel byl úspěšně upraven', FlashMessageType::SUCCESS);
			} else {
				$this->flashMessage('Uživatel byl úspěšně vytvořen', FlashMessageType::SUCCESS);
			}

			$this->redirect('AppAdmin:default');
		};

		return $this->appAdminFormFactory->create($id, $onSuccess);
	}

}
