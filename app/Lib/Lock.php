<?php

namespace Alex\Lib;

/**
 * Class Lock
 * @package Alex\Lib
 */
abstract class Lock
{
    /**
     * @var string
     */
    public $key;
    /**
     * @var
     */
    private static $locks;

    /**
     * @var mixed
     */
    private $symbols = [];

    /**
     * @var int
     */
    private $max_length;

    /**
     * @var int
     */
    public $time_to_unlock = 0;

    /**
     * @var int
     */
    public $false_attempt = 0;

    /**
     * @var string
     */
    public $password = null;

    public function open($password): bool
    {
        if (sha1($password) == $this->key) {
            $this->password       = $password;
            $this->time_to_unlock = microtime(true) - $this->time_to_unlock;

            return true;
        } else {
            return false;
        }
    }

    public function run()
    {
        $this->time_to_unlock = microtime(true);
        $this->call();
    }

    /**
     * @param int $step
     * @param string $value
     */
    private function call($step = 1, $value = '')
    {
        if (is_null($this->password)) {
            foreach ($this->symbols as $symbol) {
                if ( ! is_null($this->password)) {
                    break;
                }
                $value[$step - 1] = $symbol;
                $password         = $value;
                if ( ! $this->open($password) && $step < $this->max_length) {
                    $this->false_attempt++;
                    $this->call($step + 1, $value);
                }
            }
        }
    }

    /**
     * @param $symbols
     *
     * @return $this
     */
    public function setSymbols($symbols): self
    {
        $this->symbols = $symbols;

        return $this;
    }

    /**
     * @param $maxLength
     *
     * @return $this
     */
    public function setMaxLength($maxLength): self
    {
        $this->max_length = $maxLength;

        return $this;
    }
}
