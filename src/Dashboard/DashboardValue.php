<?php

declare(strict_types = 1);

namespace App\Dashboard;

class DashboardValue
{

	public function __construct(private string $label, private string $value)
	{
	}

	public function getLabel(): string
	{
		return $this->label;
	}

	public function getValue(): string
	{
		return $this->value;
	}

}
