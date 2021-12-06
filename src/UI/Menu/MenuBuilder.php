<?php

declare(strict_types = 1);

namespace App\UI\Menu;

class MenuBuilder
{

	/**
	 * @return array<MenuItem>
	 */
	public function buildMenu(): array
	{
		return [
			new MenuItem('Dashboard', 'default', '', 'Dashboard'),
		];
	}

}
