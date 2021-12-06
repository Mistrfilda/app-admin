<?php

declare(strict_types = 1);

namespace App\UI\Base;

use Nette\Application\UI\Presenter;

abstract class BasePresenter extends Presenter
{

	public function startup(): void
	{
		parent::startup();
		$this->template->includeBody = false;
	}

	/**
	 * @return array<string>
	 */
	public function formatLayoutTemplateFiles(): array
	{
		return array_merge([__DIR__ . '/templates/@layout.latte'], parent::formatLayoutTemplateFiles());
	}

}
