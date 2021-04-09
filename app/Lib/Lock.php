<?php

namespace Alex\Lib;

abstract class Lock
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var
     */
    private static $locks;

    public $falseAttempts = 0;  // Count of attempts

	public function open($password)
	{
		if (sha1($password) == $this->key)
			return true;
		else
			return false;
	}
}
