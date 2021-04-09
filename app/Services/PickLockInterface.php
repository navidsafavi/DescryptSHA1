<?php

namespace Alex\Services;

use Alex\Lib\Lock;

interface PickLockInterface
{

	public function unlock(Lock $lock);

	public function unlockAllLocks();

	/**
	Use this method to var_dump variable $locks
	*/
	public function varDumpLockResults();
}
