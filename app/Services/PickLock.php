<?php

namespace Alex\Services;

use Alex\Lib\Lock;
use Alex\Locks\HardLock3;
use Alex\Locks\Lock1;
use Alex\Locks\Lock2;

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

    /**
     * @param Lock $lock
     *
     * @return $this
     */
    public function unlock(Lock $lock): self
    {
        $lock->setSymbols($this->symbols)->setMaxLength(self::maxSymbols)->run();

        $result = [
            'password'             => $lock->password,
            'millisecondsToUnlock' => $lock->time_to_unlock,
            'falseAttempt'         => $lock->false_attempt
        ];

        $this->setNewLock(getClassName($lock), $result);

        return $this;
    }

    /**
     * @return $this
     */
    public function unlockAllLocks(): self
    {
        $this->unlock(new Lock1())->unlock(new Lock2())->unlock(new HardLock3());

        return $this;
    }

    public function varDumpLockResults()
    {
        var_dump(self::$locks);
    }

    private function setNewLock($keyLock, $result)
    {
        $newLock[$keyLock] = $result;
        self::$locks       = array_merge(self::$locks, $newLock);
    }

}
