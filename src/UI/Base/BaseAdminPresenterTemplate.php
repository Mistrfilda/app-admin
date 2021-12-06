<?php

declare(strict_types = 1);

namespace App\UI\Base;

use Nette\Security\User;

abstract class BaseAdminPresenterTemplate extends BasePresenterTemplate
{

	public User $user;

}
