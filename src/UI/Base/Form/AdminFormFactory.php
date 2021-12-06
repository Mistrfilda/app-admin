<?php

declare(strict_types = 1);

namespace App\UI\Base\Form;

class AdminFormFactory
{

	public function create(string|null $mappedClass = null): AdminForm
	{
		$form = new AdminForm();
		if ($mappedClass !== null) {
			$form->setMappedType($mappedClass);
		}

		return $form;
	}

}
