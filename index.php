<?php

// Run this file to crack the passwords.
// Please use an autoloader.

use Alex\Locks\Lock1;
use Alex\Locks\Lock2;

require_once __DIR__ . '/vendor/autoload.php';

$pickLock = new \Alex\Services\PickLock();
//$pickLock->unlock(new Lock1())->varDumpLockResults();
//$pickLock->unlock(new Lock2())->varDumpLockResults();
//$pickLock->unlock(new Lock2())->varDumpLockResults();
$pickLock->unlockAllLocks()->varDumpLockResults();
