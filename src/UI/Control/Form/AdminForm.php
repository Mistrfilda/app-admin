<?php

declare(strict_types = 1);

namespace App\UI\Control\Form;

use Nette\Application\UI\Form;

class AdminForm extends Form
{
	public const SELECT_PLACEHOLDER = '-- vyberte --';

	private bool $isAjax = false;

	private string|null $headingTitle = null;

	private string|null $headingText = null;

	public function ajax(): void
	{
		$this->isAjax = true;
	}

	public function setHeading(
		string|null $headingTitle,
		string|null $headingText,
	): void
	{
		$this->headingTitle = $headingTitle;
		$this->headingText = $headingText;
	}

	public function isAjax(): bool
	{
		return $this->isAjax;
	}

	public function hasHeading(): bool
	{
		return $this->headingTitle !== null || $this->headingText !== null;
	}

	public function getHeadingTitle(): string|null
	{
		return $this->headingTitle;
	}

	public function getHeadingText(): string|null
	{
		return $this->headingText;
	}

}
