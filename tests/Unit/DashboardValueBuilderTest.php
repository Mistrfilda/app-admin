<?php

declare(strict_types = 1);

namespace App\Test\Unit;

use App\Admin\AppAdminRepository;
use App\Dashboard\DashboardValueBuilderFacade;
use App\Test\UpdatedTestCase;
use Mockery;

class DashboardValueBuilderTest extends UpdatedTestCase
{

	public function testDashboardValueBuilder(): void
	{
		$appAdminRepositoryMock = Mockery::mock(AppAdminRepository::class)->makePartial();
		$appAdminRepositoryMock->expects('getCount')->andReturn(3);

		$values = (new DashboardValueBuilderFacade())->buildValues();
		self::assertCount(1, $values);
	}

}
