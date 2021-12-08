<?php

declare(strict_types = 1);

namespace App\UI\Control\Datagrid\Action;

use App\Doctrine\IEntity;
use App\UI\Control\Datagrid\Datagrid;

interface IDatagridAction
{

	public function getDatagrid(): Datagrid;

	public function getId(): string;

	public function getLabel(): string;

	public function getIcon(): string|null;

	public function getDestination(): string;

	/** @return array<DatagridActionParameter> */
	public function getParameters(): array;

	/** @return array<string, mixed> */
	public function formatParametersForAction(IEntity $row): array;

	public function getColor(): string;

	public function getTemplateFile(): string;

}
