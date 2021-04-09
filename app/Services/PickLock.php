<?php

namespace Alex\Services;

use Alex\Lib\Lock;
use Alex\Lib\PickLockInterface;

/**
 * This class has to call out the lock objects by name. i.e. 'lock1' should call
 * the class Lock1. This should not be hardcoded and must support adding of
 * new locks later on.
 * Using rainbow tables is not allowed.
 */
class PickLock implements PickLockInterface
{
    // Don't change static fields
    private static $locks = array(
        'lock1'     => array(
            'password'             => null,            // cracked password
            'millisecondsToUnlock' => 0,    // how many milliseconds did the cracking take
            'falseAttempt'         => 0            // count of tries
        ),
        'lock2'     => array(
            'password'             => null,
            'millisecondsToUnlock' => 0,
            'falseAttempt'         => 0
        ),
        'hardlock3' => array(
            'password'             => null,
            'millisecondsToUnlock' => 0,
            'falseAttempt'         => 0
        )
    );

    const minSymbols = 2;    // hint
    const maxSymbols = 4;    // hint

    private $symbols = array(
        'a',
        'b',
        'c',
        'd',
        'e',
        'f',
        'g',
        'h',
        'i',
        'j',
        'k',
        'l',
        'm',
        'n',
        'o',
        'p',
        'q',
        'r',
        's',
        't',
        'u',
        'v',
        'õ',
        'ä',
        'ö',
        'ü',
        'x',
        'y'
    );

    public function unlock(Lock $lock)
    {
        // TODO: Implement unlock() method.
    }

    public function unlockAllLocks()
    {
        // TODO: Implement unlockAllLocks() method.
    }

    public function varDumpLockResults()
    {
        // TODO: Implement varDumpLockResults() method.
    }
}
