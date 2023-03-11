<?php

declare(strict_types = 1);

namespace App\Dashboard;

use App\UI\Tailwind\TailwindColorConstant;

class DashboardValueBuilderFacade implements DashboardValueBuilder
{

	/**
	 * @return array<int, DashboardValueGroup>
	 */
	public function buildValues(): array
	{
		return [
			new DashboardValueGroup(
				DashboardValueGroupEnum::TEST,
				'TEST',
				'TEST',
				[new DashboardValue('test', 'test', TailwindColorConstant::EMERALD)],
			),
		];
	}

}
