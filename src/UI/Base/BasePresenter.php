<?php

declare(strict_types = 1);

namespace App\UI\Base;

use Nette\Application\UI\Presenter;
use function array_merge;

class BasePresenter extends Presenter
{

	/**
	 * @return array<string>
	 */
	public function formatLayoutTemplateFiles(): array
	{
		return array_merge([__DIR__ . '/templates/@layout.latte'], parent::formatLayoutTemplateFiles());
	}

}
