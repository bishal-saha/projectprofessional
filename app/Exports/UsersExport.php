<?php

namespace App\Exports;

use App\Repositories\User\UserRepository;
use App\User;

class UsersExport extends ExportManager
{
	/**
	 * @var
	 */
	private $request;

	/**
	 * @var UserRepository
	 */
	private $users;

	/**
	 * @var string
	 */
	public $fileName = 'users.csv';

	/**
	 * StatesExport constructor.
	 * @param UserRepository $states
	 * @param $request
	 */
	public function __construct(UserRepository $users, $request)
	{
		$this->request = $request;
		$this->users = $users;

		/**
		 * Overwrite the Laravel Excel variable $fileName
		 */
		$this->fileName = $this->getFileName($this->fileName, $this->request->export_type);
	}

	/**
	 * Build the query to export.
	 *
	 * @return \Illuminate\Database\Query\Builder
	 */
	public function query()
	{
		return $this->users->export($this->request->uuids);
	}

	public function headings(): array
	{
		return [
			'Name',
			'Logo',
			'UUID',
			'Status',
		];
	}
}
