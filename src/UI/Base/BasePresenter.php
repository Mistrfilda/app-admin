<?php

declare(strict_types = 1);

namespace App\UI\Base;

use Nette\Application\BadRequestException;
use Nette\Application\UI\InvalidLinkException;
use Nette\Application\UI\Presenter;

abstract class BasePresenter extends Presenter
{

	protected BasePresenterParameters $basePresenterParameters;

	public function injectBasePresenterParameters(BasePresenterParameters $basePresenterParameters): void
	{
		$this->basePresenterParameters = $basePresenterParameters;
	}

	public function startup(): void
	{
		parent::startup();
		$this->template->includeBody = false;
		$this->template->heading = null;
		$this->template->pageTitle = $this->basePresenterParameters->getPageTitle();
	}

	/**
	 * @param array<string> $links
	 * @throws InvalidLinkException
	 */
	public function isMenuLinkActive(array $links): bool
	{
		foreach ($links as $link) {
			if ($this->isLinkCurrent($link)) {
				return true;
			}
		}

		return false;
	}

	protected function processParameterIntId(): int
	{
		$id = $this->getParameter('id');
		if (is_scalar($id) === false || (int) $id === 0) {
			throw new BadRequestException('Missing parameter ID');
		}

		return (int) $id;
	}

	protected function processParameterStringId(string $parameterName = 'id'): string
	{
		$id = $this->getParameter($parameterName);
		if (is_scalar($id) === false || (string) $id === '') {
			throw new BadRequestException('Missing parameter ID');
		}

		return (string) $id;
	}

	/**
	 * @return array<string>
	 */
	public function formatLayoutTemplateFiles(): array
	{
		return array_merge([__DIR__ . '/templates/@layout.latte'], parent::formatLayoutTemplateFiles());
	}

}
