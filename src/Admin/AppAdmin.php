<?php

declare(strict_types = 1);

namespace App\Admin;

use App\Doctrine\CreatedAt;
use App\Doctrine\IEntity;
use App\Doctrine\UpdatedAt;
use App\Doctrine\Uuid;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Mistrfilda\Datetime\Types\ImmutableDateTime;

#[ORM\Entity]
#[ORM\Table('app_admin')]
class AppAdmin implements IEntity
{

	use Uuid;
	use CreatedAt;
	use UpdatedAt;

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
		ImmutableDateTime $now,
	)
	{
		$this->name = $name;
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
		$this->createdAt = $now;
		$this->updatedAt = $now;
	}

	public function update(
		string $name,
		string $password,
		ImmutableDateTime $now,
	): void
	{
		$this->name = $name;
		$this->password = $password;
		$this->updatedAt = $now;
	}

	public function changePassword(string $password, ImmutableDateTime $now): void
	{
		$this->password = $password;
		$this->updatedAt = $now;
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
