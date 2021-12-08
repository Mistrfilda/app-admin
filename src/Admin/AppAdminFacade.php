<?php

declare(strict_types = 1);

namespace App\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Mistrfilda\Datetime\DatetimeFactory;
use Nette\Security\Passwords;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\UuidInterface;

class AppAdminFacade
{

	private EntityManagerInterface $entityManager;

	private AppAdminRepository $appAdminRepository;

	private Passwords $passwords;

	private LoggerInterface $logger;

	private DatetimeFactory $datetimeFactory;

	public function __construct(
		EntityManagerInterface $entityManager,
		AppAdminRepository $appAdminRepository,
		Passwords $passwords,
		LoggerInterface $logger,
		DatetimeFactory $datetimeFactory,
	)
	{
		$this->entityManager = $entityManager;
		$this->appAdminRepository = $appAdminRepository;
		$this->passwords = $passwords;
		$this->logger = $logger;
		$this->datetimeFactory = $datetimeFactory;
	}

	public function createAppAdmin(
		string $name,
		string $username,
		string $email,
		string $password,
	): AppAdmin
	{
		$this->logger->info(
			'Creating app admin',
			[
				'name' => $name,
				'username' => $username,
				'email' => $email,
			],
		);

		$appAdmin = new AppAdmin(
			$name,
			$username,
			$email,
			$this->passwords->hash($password),
			$this->datetimeFactory->createNow(),
		);

		$this->entityManager->persist($appAdmin);
		$this->entityManager->flush();
		$this->entityManager->refresh($appAdmin);

		return $appAdmin;
	}

	public function updateAppAdmin(
		UuidInterface $appAdminId,
		string $name,
		string $password,
	): AppAdmin
	{
		$this->logger->info(
			'Updating app admin',
			[
				'appAdminId' => $appAdminId->toString(),
				'name' => $name,
				'password' => $password,
			],
		);

		$appAdmin = $this->appAdminRepository->findById($appAdminId);
		$appAdmin->update(
			$name,
			$this->passwords->hash($password),
			$this->datetimeFactory->createNow(),
		);

		$this->entityManager->flush();
		$this->entityManager->refresh($appAdmin);

		return $appAdmin;
	}

}
