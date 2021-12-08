<?php

declare(strict_types = 1);

namespace App\UI\Base;

class BasePresenterParameters
{

	public function __construct(private string $pageTitle)
	{
	}

	public function getPageTitle(): string
	{
		return $this->pageTitle;
	}

}
