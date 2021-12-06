<?php

declare(strict_types = 1);

namespace App\Admin;

use App\Doctrine\IEntity;
use App\Doctrine\Uuid;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('app_admin')]
class AppAdmin implements IEntity
{

	use Uuid;

	#[ORM\Column(type: Types::STRING)]
	private string $name;

	#[ORM\Column(type: Types::STRING, unique: true)]
	private string $username;

	#[ORM\Column(type: Types::STRING, unique: true)]
	private string $email;

	#[ORM\Column(type: Types::STRING)]
	private string $password;

	public function __construct(
		string $name,
		string $username,
		string $email,
		string $password,
	)
	{
		$this->name = $name;
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
	}

	public function update(string $name, string $password): void
	{
		$this->name = $name;
		$this->password = $password;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getUsername(): string
	{
		return $this->username;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

}
