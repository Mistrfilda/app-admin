<?php

declare(strict_types = 1);

namespace App\UI\Control\Datagrid;

use App\UI\Control\Datagrid\Action\DatagridAction;
use App\UI\Control\Datagrid\Action\DatagridActionParameter;
use App\UI\Control\Datagrid\Action\IDatagridAction;
use App\UI\Control\Datagrid\Column\ColumnBadge;
use App\UI\Control\Datagrid\Column\ColumnDatetime;
use App\UI\Control\Datagrid\Column\ColumnText;
use App\UI\Control\Datagrid\Column\IColumn;
use App\UI\Control\Datagrid\Datasource\IDataSource;
use App\UI\Control\Datagrid\Filter\FilterText;
use App\UI\Control\Datagrid\Filter\IFilter;
use App\UI\Control\Datagrid\Pagination\Pagination;
use App\UI\Control\Datagrid\Pagination\PaginationService;
use App\UI\Tailwind\TailwindColorConstant;
use Doctrine\Common\Collections\ArrayCollection;
use Mistrfilda\Datetime\DatetimeFactory;
use Nette\Application\UI\Control;

class Datagrid extends Control
{

	public const NULLABLE_PLACEHOLDER = '----';

	/** @persistent */
	public int $offset;

	/** @persistent */
	public int $limit;

	/** @var ArrayCollection<int, IColumn> */
	private ArrayCollection $columns;

	/** @var ArrayCollection<int, IFilter> */
	private ArrayCollection $filters;

	/** @var ArrayCollection<int, IDatagridAction> */
	private ArrayCollection $actions;

	private PaginationService $paginationService;

	public function __construct(private IDataSource $datasource)
	{
		$this->setPagination();
		$this->paginationService = new PaginationService();
		$this->columns = new ArrayCollection();
		$this->filters = new ArrayCollection();
		$this->actions = new ArrayCollection();
	}

	public function addColumnText(
		string $column,
		string $label,
		callable|null $getterMethod = null,
	): ColumnText
	{
		$column = new ColumnText($this, $label, $column, $getterMethod);
		$this->columns->add($column);

		return $column;
	}

	public function addColumnBadge(
		string $column,
		string $label,
		string $color,
		callable|null $getterMethod = null,
		callable|null $colorCallback = null,
	): ColumnText
	{
		$column = new ColumnBadge(
			$this,
			$label,
			$column,
			$color,
			$getterMethod,
			$colorCallback,
		);
		$this->columns->add($column);

		return $column;
	}

	public function addColumnDatetime(
		string $column,
		string $label,
		callable|null $getterMethod = null,
	): ColumnDatetime
	{
		$column = new ColumnDatetime($this, $label, $column, $getterMethod);
		$this->columns->add($column);

		return $column;
	}

	public function addColumnDate(
		string $column,
		string $label,
		callable|null $getterMethod = null,
	): ColumnDatetime
	{
		$column = new ColumnDatetime($this, $label, $column, $getterMethod);

		$column->setFormat(DatetimeFactory::DEFAULT_DATE_FORMAT);
		$this->columns->add($column);

		return $column;
	}

	/**
	 * @param array<DatagridActionParameter> $parameters
	 */
	public function addAction(
		string $id,
		string $label,
		string $destination,
		array $parameters,
		string|null $icon = null,
		string $color = TailwindColorConstant::BLUE,
	): DatagridAction
	{
		$action = new DatagridAction(
			$this,
			$id,
			$label,
			$destination,
			$parameters,
			$icon,
			$color,
		);

		$this->actions->add($action);

		return $action;
	}

	public function setFilterText(ColumnText $column): FilterText
	{
		$filter = new FilterText($column);
		$this->filters->add($filter);

		return $filter;
	}

	public function handleChangePagination(int $offset, int $limit): void
	{
		$this->offset = $offset;
		$this->limit = $limit;
		$this->redrawGridData();
	}

	public function handleArrowLeft(): void
	{
		if ($this->offset !== 0) {
			$this->offset -= $this->limit;
		}

		$this->redrawGridData();
	}

	public function handleArrowRight(): void
	{
		if ($this->offset + $this->limit < $this->datasource->getCount()) {
			$this->offset += $this->limit;
		}

		$this->redrawGridData();
	}

	public function getDatasource(): IDataSource
	{
		return $this->datasource;
	}

	public function render(): void
	{
		$template = $this->createTemplate(DatagridTemplate::class);

		$dataCount = $this->datasource->getCount();
		$data = $this->datasource->getData($this->offset, $this->limit);

		$template->filters = $this->filters;
		$template->columns = $this->columns;
		$template->actions = $this->actions;

		$template->pagination = new Pagination(
			$this->limit,
			$this->offset,
			$this->paginationService->getPagination(
				$this->offset,
				$this->limit,
				$dataCount,
			),
		);

		$template->itemsCount = $dataCount;
		$template->items = $data;
		$template->datasource = $this->datasource;

		$template->setFile(__DIR__ . '/datagrid.latte');
		$template->render();
	}

	public function setLimit(int $limit): void
	{
		$this->limit = $limit;
	}

	public function setMaxResultSet(int $limit): void
	{
		$this->setLimit($limit);
	}

	private function setPagination(): void
	{
		$this->offset = 0;
		$this->limit = 10;
	}

	private function redrawGridData(): void
	{
		$this->redrawControl('items');
		$this->redrawControl('pagination');
	}

}
